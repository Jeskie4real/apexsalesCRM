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

class UserCreateForm
{
    public static function formFields(): Grid
    {
        return Grid::make(2)
                  ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('gender')
                    ->required()
                     ->options([
                         'Male',
                         'Female',
                         'Other'
                     ]),
                DatePicker::make('birthday'),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                TextInput::make('email')
                    ->required()
                      ->email()
                      ->maxLength(255),
                Hidden::make('password')
                   ->default(Hash::make('password'))
            ]);
    }
}
