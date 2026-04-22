<?php

namespace Database\Seeders;

use App\Models\Event;
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
            ['name' => 'كلية الصيدلة',   'slug' => 'pharmacy'],
            ['name' => 'كلية الهندسة', 'slug' => 'engineering'],
            ['name' => 'كلية الطب',    'slug' => 'medicine'],
            ['name' => 'كلية طب الأسنان',   'slug' => 'dentistry'],
            ['name' => 'كلية الحقوق',         'slug' => 'law'],
            ['name' => 'كلية إدارة الأعمال',         'slug' => 'business'],
            ['name' => 'كلية التجميل',        'slug' => 'cosmetology'],
            ['name' => 'كلية التمريض',        'slug' => 'nursing'],
        ];

        foreach ($faculties as $faculty) {
            Faculty::firstOrCreate(['slug' => $faculty['slug']], $faculty);
        }

        // 2. Tags
        $tags = [
            ['name' => 'Scientific Conference', 'slug' => 'scientific-conference'],
            ['name' => 'Scientific Seminar', 'slug' => 'seminar'],
            ['name' => 'Sports Event',      'slug' => 'sports'],
            ['name' => 'Cultural Event',    'slug' => 'cultural'],
            ['name' => 'Charity Event',     'slug' => 'charity'],
            ['name' => 'Workshop',          'slug' => 'workshop'],
            ['name' => 'Lecture',           'slug' => 'lecture'],
            ['name' => 'Symposium',         'slug' => 'symposium'],
            ['name' => 'Contest',           'slug' => 'contest'],
            ['name' => 'Exhibition',        'slug' => 'exhibition'],
            ['name' => 'Conference',        'slug' => 'conference'],
            ['name' => 'Other Events',      'slug' => 'other-events'],
            ['name' => 'Technology',        'slug' => 'technology'],
            ['name' => 'Innovation',         'slug' => 'innovation'],
            ['name' => 'Health',             'slug' => 'health'],
            ['name' => 'Education',          'slug' => 'education'],
            ['name' => 'Environment',        'slug' => 'environment'],
            ['name' => 'Community Service',   'slug' => 'community-service'],
            ['name' => 'Career Development',   'slug' => 'career-development'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['slug' => $tag['slug']], $tag);
        }

        User::firstOrCreate(
            ['email' => 'ahmad@gmail.com'],
            [
                'name'              => 'Ahmad',
                'faculty_id'        => 2,
                'student_id'        => 'S12345678',
                'password'          => Hash::make('12345678'),
                'role'              => 'admin',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );
        User::firstOrCreate(
            ['email' => 'ali@gmail.com'],
            [
                'name'              => 'Ali',
                'faculty_id'        => 1,
                'student_id'        => 'A12345678',
                'password'          => Hash::make('12345678'),
                'role'              => 'super_admin',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        User::firstOrCreate(
            ['email' => 'mahmod@gmail.com'],
            [
                'name'              => 'Mahmod',
                'faculty_id'        => 2,
                'student_id'        => 'D12345678',
                'password'          => Hash::make('12345678'),
                'role'              => 'student',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        User::firstOrCreate(
            ['email' => 'AmrStudent@gmail.com'],
            [
                'name'              => 'Amr',
                'faculty_id'        => 2,
                'student_id'        => 'S87654321',
                'password'          => Hash::make('12345678'),
                'role'              => 'student',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        User::firstOrCreate(
            ['email' => 'AmrAdmin@gmail.com'],
            [
                'name'              => 'Amr',
                'faculty_id'        => 2,
                'student_id'        => 'S11223344',
                'password'          => Hash::make('12345678'),
                'role'              => 'admin',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        User::firstOrCreate(
            ['email' => 'AmrManager@gmail.com'],
            [
                'name'              => 'Amr',
                'faculty_id'        => 2,
                'student_id'        => 'G11223344',
                'password'          => Hash::make('12345678'),
                'role'              => 'super_admin',
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );



        // $events = [
        //     [
        //         'title'        => 'ورشة عمل',
        //         'slug'         => 'workshop',
        //         'type'         => 'workshop',
        //         'description'  => 'ورشة عمل تفاعلية لتطوير المهارات العملية للطلاب.',
        //         'location'     => 'قاعة 101 - كلية الهندسة',
        //         'start_date'   => '2026-05-10',
        //         'end_date'     => '2026-06-10',
        //         'image'        => 'events/workshop.webp',
        //         'num_tickets'  => 80,
        //         'is_public'    => true,
        //         'user_id'      => 1,
        //         'faculty_id'   => 2
        //     ],
        //     [
        //         'title'        => 'محاضرة',
        //         'slug'         => 'lecture',
        //         'type'         => 'lecture',
        //         'description'  => 'محاضرة علمية حول أحدث التطورات في مجال التقنية.',
        //         'location'     => 'القاعة الكبرى',
        //         'start_date'   => '2026-05-15',
        //         'end_date'     => '2026-06-15',
        //         'image'        => 'events/lecture.jpg',
        //         'num_tickets'  => 150,
        //         'is_public'    => true,
        //         'user_id'      => 1,
        //         'faculty_id'   => 2
        //     ],
        //     [
        //         'title'        => 'ندوة',
        //         'slug'         => 'symposium',
        //         'type'         => 'seminar',
        //         'description'  => 'ندوة علمية ونقاش مفتوح مع الخبراء.',
        //         'location'     => 'قاعة الندوات',
        //         'start_date'   => '2026-05-20',
        //         'end_date'     => '2026-06-20',
        //         'image'        => 'events/symposium.png',
        //         'num_tickets'  => 100,
        //         'is_public'    => true,
        //         'user_id'      => 1,
        //         'faculty_id'   => 1
        //     ],
        //     [
        //         'title'        => 'مسابقة',
        //         'slug'         => 'contest',
        //         'type'         => 'competition',
        //         'description'  => 'مسابقة بين الطلاب في مجال البرمجة والابتكار.',
        //         'location'     => 'مختبر الحاسوب',
        //         'start_date'   => '2026-06-01',
        //         'end_date'     => '2026-07-01',
        //         'image'        => 'events/competition.webp',
        //         'num_tickets'  => 60,
        //         'is_public'    => true,
        //         'user_id'      => 1,
        //         'faculty_id'   => 1
        //     ],
        //     [
        //         'title'        => 'معرض',
        //         'slug'         => 'exhibition',
        //         'type'         => 'exhibition',
        //         'description'  => 'معرض لعرض مشاريع وأعمال الطلاب.',
        //         'location'     => 'بهو الكلية',
        //         'start_date'   => '2026-06-10',
        //         'end_date'     => '2026-07-12',
        //         'image'        => 'events/exhibition.webp',
        //         'num_tickets'  => 20,
        //         'is_public'    => true,
        //         'user_id'      => 1,
        //         'faculty_id'   => 3
        //     ],
        //     [
        //         'title'        => 'مؤتمرات',
        //         'slug'         => 'conferences',
        //         'type'         => 'conference',
        //         'description'  => 'مؤتمر علمي يجمع المتخصصين والأكاديميين.',
        //         'location'     => 'المركز الثقافي',
        //         'start_date'   => '2026-06-20',
        //         'end_date'     => '2026-07-22',
        //         'image'        => 'events/conferences.webp',
        //         'num_tickets'  => 300,
        //         'is_public'    => true,
        //         'user_id'      => 1,
        //         'faculty_id'   => 3
        //     ],
        //     [
        //         'title'        => 'نشاط ثقافي',
        //         'slug'         => 'cultural-event',
        //         'type'         => 'cultural',
        //         'description'  => 'نشاط ثقافي وترفيهي للطلاب.',
        //         'location'     => 'ساحة الجامعة',
        //         'start_date'   => '2026-07-01',
        //         'end_date'     => '2026-08-01',
        //         'image'        => 'events/cultural-event.webp',
        //         'num_tickets'  => 200,
        //         'is_public'    => true,
        //         'user_id'      => 1,
        //         'faculty_id'   => 4
        //     ],
        //     [
        //         'title'        => 'نشاط رياضي',
        //         'slug'         => 'sports-event',
        //         'type'         => 'sports',
        //         'description'  => 'نشاط رياضي وترفيهي.',
        //         'location'     => 'الملعب الرياضي',
        //         'start_date'   => '2026-07-10',
        //         'end_date'     => '2026-08-10',
        //         'image'        => 'events/sports.webp',
        //         'num_tickets'  => 150,
        //         'is_public'    => true,
        //         'user_id'      => 1,
        //         'faculty_id'   => 4
        //     ],
        //     [
        //         'title'        => 'نشاط خيري',
        //         'slug'         => 'charity-event',
        //         'type'         => 'charity',
        //         'description'  => 'نشاط خيري واجتماعي.',
        //         'location'     => 'بهو الجامعة',
        //         'start_date'   => '2026-07-15',
        //         'end_date'     => '2026-08-15',
        //         'image'        => 'events/charity.webp',
        //         'num_tickets'  => 50,
        //         'is_public'    => true,
        //         'user_id'      => 1,
        //         'faculty_id'   => 5
        //     ],

        // ];

        // foreach ($events as $event) {
        //     Event::firstOrCreate(
        //         ['slug' => $event['slug']],
        //         $event
        //     );
        // }
    }
}
