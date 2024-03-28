<?php

namespace App\Filament\Resources\TeamManagerResource\Pages;

use App\Filament\Resources\TeamManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTeamManager extends ViewRecord
{
    protected static string $resource = TeamManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
