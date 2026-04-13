<x-main-layout>
    <section class="bg-[#F7F8F0] dark:bg-[#222831]">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-[#355872] lg:text-4xl dark:text-[#DFD0B8] mb-10">الكليات</h1>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($faculties as $faculty)
                    <a href="{{ route('eventIndex', ['faculty_id' => $faculty->id]) }}"
                        class="block bg-white dark:bg-[#393E46] p-8 rounded-3xl shadow hover:shadow-2xl transition text-center border border-transparent hover:border-[#7AAACE]">
                        <div class="text-6xl mb-4">🏛️</div>
                        <h3 class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">{{ $faculty->name }}</h3>
                        <p class="text-[#948979] mt-2 text-sm">عرض جميع الفعاليات</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-main-layout>
