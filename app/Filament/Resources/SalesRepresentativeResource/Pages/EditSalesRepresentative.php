<?php

namespace App\Filament\Resources\SalesRepresentativeResource\Pages;

use App\Filament\Resources\SalesRepresentativeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesRepresentative extends EditRecord
{
    protected static string $resource = SalesRepresentativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
