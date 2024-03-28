<?php

namespace App\Filament\Resources\OrganizationFieldResource\Pages;

use App\Filament\Resources\OrganizationFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrganizationFields extends ListRecords
{
    protected static string $resource = OrganizationFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
