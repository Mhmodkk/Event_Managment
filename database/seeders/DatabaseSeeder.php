<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Faculty::create(['name' => 'Faculty of Pharmacy', 'slug' => 'pharmacy']);
        Faculty::create(['name' => 'Faculty of Engineering', 'slug' => 'engineering']);
        Faculty::create(['name' => 'Faculty of Medicine', 'slug' => 'medicine']);
        Faculty::create(['name' => 'Faculty of Dentistry', 'slug' => 'dentistry']);
        Faculty::create(['name' => 'Faculty of Law', 'slug' => 'law']);
        Faculty::create(['name' => 'Faculty of Arts', 'slug' => 'arts']);

        Tag::create(['name' => 'Laravel', 'slug' => 'laravel']);
        Tag::create(['name' => 'Vue JS', 'slug' => 'vue-js']);
        Tag::create(['name' => 'Scientific Seminar', 'slug' => 'seminar']);
        Tag::create(['name' => 'Sports Event', 'slug' => 'sports']);
    }
}
