<x-main-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <h1 class="text-3xl md:text-4xl font-bold text-[#355872] dark:text-[#DFD0B8] tracking-tight">
                @if (request('faculty_id'))
                    فعاليات {{ optional(\App\Models\Faculty::find(request('faculty_id')))->name ?? 'غير محددة' }}
                @elseif(request('type'))
                    @php
                        $types = [
                            'workshop' => 'ورشة عمل',
                            'lecture' => 'محاضرة',
                            'seminar' => 'ندوة',
                            'competition' => 'مسابقة',
                            'exhibition' => 'معرض',
                            'conference' => 'مؤتمر',
                            'cultural' => 'نشاط ثقافي',
                            'sports' => 'نشاط رياضي',
                            'charity' => 'نشاط خيري',
                            'other' => 'فعاليات أخرى',
                        ];
                    @endphp
                    فعاليات {{ $types[request('type')] ?? 'جميع الفعاليات' }}
                @else
                    جميع الفعاليات
                @endif
            </h1>

            @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <a href="{{ route('events.create') }}"
                    class="flex items-center gap-2 px-6 py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-2xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    <span class="text-xl">+</span> إضافة فعالية جديدة
                </a>
            @endif
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($events as $event)
                <div
                    class="group relative bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl overflow-hidden shadow-md hover:shadow-2xl border border-[#9CD5FF] dark:border-[#948979] transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">

                    @if (auth()->check() && $event->faculty_id == auth()->user()->faculty_id)
                        <div
                            class="absolute top-4 right-4 z-10 bg-[#7AAACE]/90 backdrop-blur-sm text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg">
                            كليتي
                        </div>
                    @endif

                    <div class="relative overflow-hidden">
                        <img class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110"
                            src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <a href="{{ route('eventShow', $event->id) }}"
                            class="block text-xl font-bold text-[#355872] dark:text-[#DFD0B8] line-clamp-2 group-hover:text-[#7AAACE] transition-colors duration-300">
                            {{ $event->title }}
                        </a>

                        <div class="flex items-center gap-2">
                            <span class="text-xs font-medium bg-[#7AAACE] text-white px-4 py-2 rounded-full shadow-sm">
                                {{ $event->faculty->name ?? 'غير محدد' }}
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            @foreach ($event->tags as $tag)
                                <span
                                    class="text-xs px-4 py-2 bg-[#9CD5FF] dark:bg-[#948979] dark:text-[#222831] rounded-full font-medium shadow-sm transition-transform duration-200 group-hover:scale-105">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full text-center py-20 bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl border border-[#9CD5FF] dark:border-[#948979] shadow-sm">
                    <svg class="w-16 h-16 mx-auto text-[#948979] mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-[#948979] dark:text-[#948979] text-lg font-medium">لا توجد فعاليات تطابق معايير
                        التصفية حالياً</p>
                    <p class="text-sm text-[#7AAACE] mt-2">حاول تغيير معايير البحث أو تصفح الأرشيف</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $events->links() }}
        </div>
    </div>
</x-main-layout>
