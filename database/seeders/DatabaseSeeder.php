<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CustomField;
use App\Models\LeadSource;
use App\Models\PipelineStage;
use App\Models\Role;
use App\Models\User;
use App\Models\contact;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $leadSources = [
            'Referral',
            'Google Search',
            'TikTok',
            'Twitter',
            'LinkedIn',
            'Print Media',
        ];
        foreach ($leadSources as $leadSource) {
            LeadSource::create(['name' => $leadSource]);
        }

        $tags = [
            'Priority',
            'VIP'
        ];
//
//        foreach ($tags as $tag) {
//            Tag::create(['name' => $tag]);
//        }

       $this->call([
           RoleSeeder::class,
           UsersSeeder::class,
           PipelineStageSeeder::class,
           CustomFieldSeeder::class,
           ItemSeeder::class,
           OrganizationSeeder::class
       ]);

    }
}
