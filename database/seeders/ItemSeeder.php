<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Samsung S8', 'price' => 12099],
            ['name' => 'Techno Phantom', 'price' => 20099],
            ['name' => 'iPhone 15', 'price' => 15599],
            ['name' => 'iPhone 14', 'price' => 99999],
        ];

        foreach ($products as $product) {
            Item::create($product);
        }
    }
}
