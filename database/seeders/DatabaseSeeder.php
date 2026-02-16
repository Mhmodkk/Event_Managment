<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Country::create(['name' => 'United States']);
        Country::create(['name' => 'Syria']);

        City::create(['country_id' => 1,'name' => 'New York',]);
        City::create(['country_id' => 1,'name' => 'Los Angeles',]);
        City::create(['country_id' => 1,'name' => 'Kalifornia',]);
        City::create(['country_id' => 2,'name' => 'Homs',]);
        City::create(['country_id' => 2,'name' => 'Damascus',]);
        City::create(['country_id' => 2,'name' => 'Raqqa',]);

        Tag::create(['name' => 'Laravel', 'slug' => 'laravel',]);
        Tag::create(['name' => 'Vue JS', 'slug' => 'vue-js',]);
        Tag::create(['name' => 'Livewire', 'slug' => 'livewire',]);

    }
}
