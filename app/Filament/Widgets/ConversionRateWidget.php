<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ConversionRateWidget extends ChartWidget
{
    protected static ?string $heading = 'Deal Conversion rate';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
