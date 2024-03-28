<?php

namespace App\Filament\Forms;


use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Hash;

class SalesRepCreateForm
{
    public static function formFields(int|null $teamId = null): Grid
    {

        if($teamId == null){
            return Grid::make(2)
                ->schema(
                    [
                        Select::make('team_id')
                            ->relationship('team','name')
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required(),
                            ]),
                        Select::make('user_id')
                            ->relationship('user','name')
                            ->required()
                            ->createOptionForm([
                                UserCreateForm::formFields(),
                            ]),
                    ]);
        }

        return Grid::make(2)
                  ->schema(
                      [
                      Hidden::make('team_id')
                          ->default($teamId),
                      Select::make('user_id')
                          ->relationship('user','name')
                          ->required()
                          ->createOptionForm([
                              UserCreateForm::formFields(),
                          ]),
            ]);
    }
}
