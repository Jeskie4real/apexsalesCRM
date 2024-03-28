<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orgs = [
            ['name' => 'Test organization', 'industry' => 'Manufacturing','orgsize'=> 30],
            ['name' => 'Test organization 1', 'industry' => 'IT','orgsize'=> 30],
            ['name' => 'Test organization 3', 'industry' => 'Farming','orgsize'=> 30],
            ['name' => 'Test organization 4', 'industry' => 'Engineering','orgsize'=> 30],

        ];

        foreach ($orgs as $orgs) {
            Organization::create($orgs);
        }
    }
}
