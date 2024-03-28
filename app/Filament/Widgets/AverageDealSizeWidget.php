<?php

namespace App\Filament\Widgets;

use App\Models\Deal;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class AverageDealSizeWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Deal::query()
            )
            ->columns([
                // ...
            ]);
    }
}
