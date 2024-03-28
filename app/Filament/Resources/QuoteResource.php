<?php

namespace App\Filament\Resources;

use App\Filament\Forms\QuoteItemsForm;
use App\Models\Deal;
use App\Models\Item;
use App\Models\Organization;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Quote;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\QuoteResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuoteResource\RelationManagers;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Quotes and Invoices';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('quote_date')
                    ->default(Carbon::now())
                    ->required(),
                Forms\Components\DatePicker::make('expiry_date')
                    ->required(),
//                Forms\Components\Hidden::make('discount')
//                    ->default(0),
                Forms\Components\Select::make('status')
                    ->searchable()
                    ->options(
                        [
                            'pending'=>'Pending',
                            'draft'=>'Draft',
                            'cancelled'=>'Cancelled',
                            'closed'=>'Closed',
                        ]
                    )
                    ->required(),

                Forms\Components\Select::make('deal_id')
                    ->searchable()
                    ->relationship('deal')
                    ->options(Deal::with('contact')->get()->pluck('contact.last_name','id'))
                    ->required(),
                Forms\Components\Select::make('organization_id')
                    ->options(Organization::query()->pluck('name','id'))
                    ->searchable()
                    ->live()
                    ->required(),
                Section::make()
                    ->columns(1)
                    ->schema([
                        Forms\Components\Repeater::make('quoteItems')
                            ->relationship('quoteItems')
                            ->schema([
                                Forms\Components\Select::make('item_id')
                                    ->relationship('item', 'name')
                                    ->disableOptionWhen(function ($value, $state, Get $get) {
                                        return collect($get('../*.item_id'))
                                            ->reject(fn ($id) => $id == $state)
                                            ->filter()
                                            ->contains($value);
                                    })
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set, $livewire) {
                                        $set('price', Item::find($get('item_id'))->price);
                                        self::updateTotals($get, $livewire);
                                    })
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('price')
                                            ->required()
                                            ->numeric()
                                            ->prefix('KES'),
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, $livewire) {
                                        self::updateTotals($get, $livewire);
                                    })
                                    ->prefix('KES'),
                                Forms\Components\TextInput::make('quantity')
                                    ->integer()
                                    ->default(1)
                                    ->required()
                                    ->live()
                                ,
                                Forms\Components\Hidden::make('total')
                                    ->default(1)
                                    ->required()
                                    ->live()
                            ])
                            ->live()
                            ->afterStateUpdated(function (Get $get, $livewire) {
                                self::updateTotals($get, $livewire);
                            })
                            ->afterStateHydrated(function (Get $get, $livewire) {
                                self::updateTotals($get, $livewire);
                            })
                            ->deleteAction(
                                fn (Action $action) => $action->after(fn (Get $get, $livewire) => self::updateTotals($get, $livewire)),
                            )
                            ->reorderable(false)
                            ->columns(3)
                    ]),
                Section::make()
                    ->columns(1)
                    ->maxWidth('1/2')
                    ->schema([
                        Forms\Components\TextInput::make('subtotal')
                            ->numeric()
                            ->readOnly()
                            ->prefix('KES')
                            ->afterStateUpdated(function (Get $get, $livewire) {
                                self::updateTotals($get, $livewire);
                            }),
//                        Forms\Components\TextInput::make('discount')
//                            ->label('Discount')
//                            ->suffix('%')
//                            ->required()
//                            ->numeric()
//                            ->default(20)
//                            ->live(true)
//                            ->afterStateUpdated(function (Get $get, $livewire) {
//                                self::updateTotals($get, $livewire);
//                            }),
                        Forms\Components\TextInput::make('total')
                            ->numeric()
                            ->readOnly()
                            ->prefix('KES')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('deal_id')
                    ->formatStateUsing(function ($record) {
                        return $record->deal->contact->first_name . ' ' . $record->deal->contact->last_name;
                    })
//                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
//                Tables\Columns\TextColumn::make('discount')
//                    ->numeric()
//                    ->suffix('%')
//                    ->sortable(),
                Tables\Columns\TextColumn::make('subtotal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(function ($record) {
                return Pages\ViewQuote::getUrl([$record]);
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuotes::route('/'),
            'create' => Pages\CreateQuote::route('/create'),
            'view' => Pages\ViewQuote::route('/{record}'),
            'edit' => Pages\EditQuote::route('/{record}/edit'),
        ];
    }

    public static function updateTotals(Get $get, $livewire): void
    {
        // Retrieve the state path of the form. Most likely, it's `data` but could be something else.
        $statePath = $livewire->getFormStatePath();

        $items = data_get($livewire, $statePath . '.quoteItems');
        if (collect($items)->isEmpty()) {
            return;
        }
        $selectedItems = collect($items)->filter(fn ($item) => !empty($item['item_id']) && !empty($item['quantity']));

        $prices = collect($items)->pluck('price', 'item_id');

        $subtotal = $selectedItems->reduce(function ($subtotal, $item) use ($prices) {
            return $subtotal + ($prices[$item['item_id']] * $item['quantity']);
        }, 0);

        data_set($livewire, $statePath . '.subtotal', number_format($subtotal, 2, '.', ''));
        data_set($livewire, $statePath . '.total', number_format($subtotal , 2, '.', ''));
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ViewEntry::make('invoice')
                    ->columnSpanFull()
                    ->viewData([
                        'record' => $infolist->record
                    ])
                    ->view('infolists.components.quote-invoice-view')
            ]);
    }
}
