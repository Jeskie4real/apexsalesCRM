<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ActivityCalender extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.activity-calender';
    protected static bool $shouldRegisterNavigation = false;
}
