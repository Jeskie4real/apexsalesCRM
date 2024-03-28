<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Filament\Resources\QuoteResource;
use App\Filament\Resources\QuoteResource\Pages\EditQuote;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Illuminate\Support\Facades\URL;


class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
{
    return [
        Action::make('Edit Invoice')
            ->icon('heroicon-m-pencil-square')
            ->url(EditInvoice::getUrl([$this->record])),
        Action::make('Download Invoice')
            ->icon('heroicon-s-document-check')
            ->url(URL::signedRoute('invoice.pdf', [$this->record->id]), true),
    ];
}
}
