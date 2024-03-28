<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class SalesWidget extends ChartWidget
{
    protected static ?string $heading = 'Monthly sales';

    protected function getData(): array
    {
        $labels = [];
        $data = [];

// Fetch data grouped by month
        $invoices = Invoice::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        foreach ($invoices as $invoice) {
            // Format month as three-letter abbreviation (e.g., 'Jan', 'Feb', etc.)
            $monthLabel = Carbon::createFromDate(null, $invoice->month, null)->format('M');

            // Push the month label to the labels array
            $labels[] = $monthLabel;

            // Push the total count for the month to the data array
            $data[] = $invoice->total;
        }

        // Create the final array structure
        $result = [
            'datasets' => [
                [
                    'label' => 'Monthly Sales',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
        return $result;
    }

    protected function getType(): string
    {
        return 'line';
    }
}
