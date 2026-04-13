<x-main-layout>
    <section class="bg-[#F7F8F0] dark:bg-[#222831]">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-[#355872] lg:text-4xl dark:text-[#DFD0B8] mb-10">أنواع الفعاليات</h1>

            @php
                $types = [
                    'workshop' => 'ورشة عمل',
                    'course' => 'دورة تدريبية',
                    'lecture' => 'محاضرة علمية',
                    'orientation' => 'محاضرة تعريفية',
                    'party' => 'حفلة تعارف',
                    'trip' => 'رحلة علمية',
                    'exhibition' => 'معرض',
                    'sports' => 'فعالية رياضية',
                    'hackathon' => 'مسابقة برمجية',
                    'job_fair' => 'ندوة توظيف',
                ];
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($types as $key => $name)
                    <a href="{{ route('eventIndex', ['type' => $key]) }}"
                        class="block bg-white dark:bg-[#393E46] p-8 rounded-3xl shadow hover:shadow-2xl transition text-center border border-transparent hover:border-[#7AAACE]">
                        <div class="text-6xl mb-4">📌</div>
                        <h3 class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">{{ $name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-main-layout>
