<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Faculties
        $faculties = [
            ['name' => 'Faculty of Pharmacy',   'slug' => 'pharmacy'],
            ['name' => 'Faculty of Engineering', 'slug' => 'engineering'],
            ['name' => 'Faculty of Medicine',    'slug' => 'medicine'],
            ['name' => 'Faculty of Dentistry',   'slug' => 'dentistry'],
            ['name' => 'Faculty of Law',         'slug' => 'law'],
            ['name' => 'Faculty of Arts',        'slug' => 'arts'],
        ];

        foreach ($faculties as $faculty) {
            Faculty::firstOrCreate(['slug' => $faculty['slug']], $faculty);
        }

        // 2. Tags
        $tags = [
            ['name' => 'Laravel',           'slug' => 'laravel'],
            ['name' => 'Vue JS',            'slug' => 'vue-js'],
            ['name' => 'Scientific Seminar', 'slug' => 'seminar'],
            ['name' => 'Sports Event',      'slug' => 'sports'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['slug' => $tag['slug']], $tag);
        }

        User::firstOrCreate(
            ['email' => 'ahmad@gmail.com'],
            [
                'name'              => 'Ahmad',
                'image'             => 'profiles/default-organizer.jpg',
                'faculty_id'        => 2,
                'password'          => Hash::make('12345678'),
                'role'              => 'organizer',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        User::firstOrCreate(
            ['email' => 'mahmod@gmail.com'],
            [
                'name'              => 'Mahmod',
                'image'             => 'profiles/default-student.jpg',
                'faculty_id'        => 2,
                'password'          => Hash::make('12345678'),
                'role'              => 'student',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );
    }
}
