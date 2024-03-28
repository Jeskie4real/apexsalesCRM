<?php

namespace App\Filament\Resources\SalesRepresentativeResource\Pages;

use App\Filament\Resources\SalesRepresentativeResource;
use App\Models\SalesRepresentative;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateSalesRepresentative extends CreateRecord
{
    protected static string $resource = SalesRepresentativeResource::class;

}
