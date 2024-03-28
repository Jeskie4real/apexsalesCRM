<?php

namespace App\Filament\Resources\SalesRepresentativeResource\Pages;

use App\Filament\Resources\SalesRepresentativeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesRepresentative extends ViewRecord
{
    protected static string $resource = SalesRepresentativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
