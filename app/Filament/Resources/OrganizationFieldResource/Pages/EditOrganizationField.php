<?php

namespace App\Filament\Resources\OrganizationFieldResource\Pages;

use App\Filament\Resources\OrganizationFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganizationField extends EditRecord
{
    protected static string $resource = OrganizationFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
