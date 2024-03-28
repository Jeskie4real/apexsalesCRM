<?php

namespace App\Filament\Resources;

use App\Filament\Forms\SalesRepCreateForm;
use App\Filament\Forms\UserCreateForm;
use App\Filament\Resources\SalesRepresentativeResource\Pages;
use App\Filament\Resources\SalesRepresentativeResource\RelationManagers;
use App\Models\SalesRepresentative;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalesRepresentativeResource extends Resource
{
    protected static ?string $model = SalesRepresentative::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Sales Teams';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SalesRepCreateForm::formFields()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('team.name')
                    ->searchable()
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListSalesRepresentatives::route('/'),
            'create' => Pages\CreateSalesRepresentative::route('/create'),
            'view' => Pages\ViewSalesRepresentative::route('/{record}'),
            'edit' => Pages\EditSalesRepresentative::route('/{record}/edit'),
        ];
    }
}
