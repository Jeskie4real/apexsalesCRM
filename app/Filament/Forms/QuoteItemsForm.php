<?php

namespace App\Filament\Forms;


use App\Filament\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\Item;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Hash;

class QuoteItemsForm
{

    public static function formFields(): Grid
    {
        return Grid::make(2)
                  ->schema([
                      Section::make()
                          ->columns(1)
                          ->schema([
                              Repeater::make('quoteItems')
                                  ->relationship()
                                  ->schema([
                                      Select::make('item_id')
                                          ->relationship('item', 'name')
                                          ->disableOptionWhen(function ($value, $state, Get $get) {
                                              return collect($get('../*.item_id'))
                                                  ->reject(fn ($id) => $id == $state)
                                                  ->filter()
                                                  ->contains($value);
                                          })
                                          ->live()
                                          ->afterStateUpdated(function (Get $get, Set $set, $livewire){
                                              $set('price', Item::find($get('item_id'))->price);
                                              InvoiceResource::updateTotals($get, $livewire);
                                          })
                                          ->createOptionForm([
                                              TextInput::make('name')
                                                  ->required()
                                                  ->maxLength(255),
                                              TextInput::make('price')
                                                  ->required()
                                                  ->numeric()
                                                  ->prefix('KES'),
                                          ])
                                          ->required(),
                                      TextInput::make('price')
                                          ->required()
                                          ->numeric()
                                          ->live()
                                          ->afterStateUpdated(function (Get $get, $livewire) {
                                              InvoiceResource::updateTotals($get, $livewire);
                                          })
                                          ->prefix('KES'),
                                      TextInput::make('quantity')
                                          ->integer()
                                          ->default(1)
                                          ->required()
                                          ->live()
                                  ])
                                  ->live()
                                  ->afterStateUpdated(function (Get $get, $livewire) {
                                      InvoiceResource::updateTotals($get, $livewire);
                                  })
                                  ->afterStateHydrated(function (Get $get, $livewire) {
                                      InvoiceResource::updateTotals($get, $livewire);
                                  })
                                  ->deleteAction(
                                      fn (Action $action) => $action->after(fn (Get $get, $livewire) => InvoiceResource::updateTotals($get, $livewire)),
                                  )
                                  ->reorderable(false)
                                  ->columns(3)
                          ]),
                      Section::make()
                          ->columns(1)
                          ->maxWidth('1/2')
                          ->schema([
                              TextInput::make('subtotal')
                                  ->numeric()
                                  ->readOnly()
                                  ->prefix('KES')
                                  ->afterStateUpdated(function (Get $get, $livewire) {
                                      InvoiceResource::updateTotals($get, $livewire);
                                  }),
                              TextInput::make('discount')
                                  ->label('Discount')
                                  ->suffix('%')
                                  ->required()
                                  ->numeric()
                                  ->default(20)
                                  ->live(true)
                                  ->afterStateUpdated(function (Get $get, $livewire) {
                                      InvoiceResource::updateTotals($get, $livewire);
                                  }),
                              TextInput::make('total')
                                  ->numeric()
                                  ->readOnly()
                                  ->prefix('KES')
                          ])
            ]);
    }
}
