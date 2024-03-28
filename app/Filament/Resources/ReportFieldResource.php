<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportFieldResource\Pages;
use App\Filament\Resources\ReportFieldResource\RelationManagers;
use App\Models\ReportField;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportFieldResource extends Resource
{
    protected static ?string $model = ReportField::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = "Reports";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('report_id')
                    ->relationship('report', 'name')
                    ->required(),
                Forms\Components\TextInput::make('field')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('report.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('field')
                    ->searchable(),
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
            'index' => Pages\ListReportFields::route('/'),
            'create' => Pages\CreateReportField::route('/create'),
            'edit' => Pages\EditReportField::route('/{record}/edit'),
        ];
    }
}
