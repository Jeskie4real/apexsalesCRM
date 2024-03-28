<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@apex.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'super-admin')->first()->id,
        ]);

        User::factory()->create([
            'name' => 'Sales Manager',
            'email' => 'employee@apex.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'employee')->first()->id,
        ]);
        User::factory()->create([
            'name' => 'Sales Rep 1',
            'email' => 'salesrep@apex.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'employee')->first()->id,
        ]);


    }
}
