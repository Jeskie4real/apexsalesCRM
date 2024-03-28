<?php

namespace App\Filament\Resources;

use App\Filament\Forms\UserCreateForm;
use App\Filament\Resources\TeamManagerResource\Pages;
use App\Filament\Resources\TeamManagerResource\RelationManagers;
use App\Models\Team;
use App\Models\TeamManager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamManagerResource extends Resource
{
    protected static ?string $model = TeamManager::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Sales Teams';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user','name')
                    ->required()
                    ->createOptionForm([
                        UserCreateForm::formFields(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('team')
                    ->getStateUsing(fn(TeamManager $record) =>
                       Team::query()->where('team_manager_id', $record->id)?->first()?->name ?? ''
                    )
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
            'index' => Pages\ListTeamManagers::route('/'),
            'create' => Pages\CreateTeamManager::route('/create'),
            'view' => Pages\ViewTeamManager::route('/{record}'),
            'edit' => Pages\EditTeamManager::route('/{record}/edit'),
        ];
    }
}
