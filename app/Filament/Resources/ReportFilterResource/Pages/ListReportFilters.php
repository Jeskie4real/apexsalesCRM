<?php

namespace App\Filament\Resources\ReportFilterResource\Pages;

use App\Filament\Resources\ReportFilterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReportFilters extends ListRecords
{
    protected static string $resource = ReportFilterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
