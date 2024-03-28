<?php

namespace Database\Seeders;

use App\Models\CustomField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customFields = [
            'Gender',
            'Salutation',
            'Next of Kin',
        ];

        foreach ($customFields as $customField) {
            CustomField::create(['name' => $customField]);
        }
    }
}
