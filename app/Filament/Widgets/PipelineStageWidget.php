<?php

namespace App\Filament\Widgets;

use App\Models\PipelineStage;
use Filament\Widgets\ChartWidget;

class PipelineStageWidget extends ChartWidget
{
    protected static ?string $heading = 'Pipeline Stage Summary';

    protected function getData(): array
    {
        $pipelineStages = PipelineStage::withCount('deals')->get();

        // Initialize arrays for labels and data
        $labels = $pipelineStages->pluck('name')->toArray();
        $data = $pipelineStages->pluck('deals_count')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Leads per Pipeline Stage',
                    'data' => $data,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
