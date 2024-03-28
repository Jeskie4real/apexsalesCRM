<?php

namespace App\Filament\Resources\ReportFieldResource\Pages;

use App\Filament\Resources\ReportFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReportFields extends ListRecords
{
    protected static string $resource = ReportFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
