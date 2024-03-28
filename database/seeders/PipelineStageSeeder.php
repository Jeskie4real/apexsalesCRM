<?php

namespace Database\Seeders;

use App\Models\PipelineStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PipelineStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pipelineStages = [
            [
                'name' => 'Lead',
                'position' => 1,
                'is_default' => true,
            ],
            [
                'name' => 'Prospect',
                'position' => 2,
            ],
            [
                'name' => 'Proposal/Quote',
                'position' => 3,
            ],
            [
                'name' => 'Negotiation',
                'position' => 4,
            ],
            [
                'name' => 'Closed/Won',
                'position' => 5,
            ],
            [
                'name' => 'Closed/Lost',
                'position' => 6,
            ],
            [
                'name' => 'Renewal',
                'position' => 7,
            ],
            [
                'name' => 'Expansion',
                'position' => 8,
            ]
        ];

        foreach ($pipelineStages as $stage) {
            PipelineStage::create($stage);
        }

    }
}
