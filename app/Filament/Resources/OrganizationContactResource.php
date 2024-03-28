<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationContactResource\Pages;
use App\Filament\Resources\OrganizationContactResource\RelationManagers;
use App\Models\Organization;
use App\Models\OrganizationContact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganizationContactResource extends Resource
{
    protected static ?string $model = OrganizationContact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = "Organizations";
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('organization_id')
                    ->searchable()
                    ->required()
                    ->relationship('organization','name'),
                Forms\Components\Select::make('contact_id')
                    ->relationship('contact','first_name')
//                    ->formatStateUsing(function (Organization $record) {
//                        return $record->contact->first_name . ' ' . $record->contact->last_name;
//                    })
                    ->searchable(['contact.first_name', 'contact.last_name'])
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('organization_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_id')
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
            ]);
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
            'index' => Pages\ListOrganizationContacts::route('/'),
            'create' => Pages\CreateOrganizationContact::route('/create'),
            'edit' => Pages\EditOrganizationContact::route('/{record}/edit'),
        ];
    }
}
