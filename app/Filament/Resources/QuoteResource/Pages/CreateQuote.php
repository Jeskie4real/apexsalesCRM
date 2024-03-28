<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Filament\Resources\QuoteResource;
use App\Models\Contact;
use App\Models\Deal;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $contactId = Deal::find($data['deal_id'])->contact_id;
        $data['contact_id'] = $contactId;

       return $data;
    }
}
