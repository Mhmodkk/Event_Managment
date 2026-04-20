<x-main-layout>
    <!-- Hero Section -->
    <section
        class="bg-gradient-to-br from-[#355872] to-[#7AAACE] dark:from-[#222831] dark:to-[#393E46] text-white py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('logos/HPU.png') }}" alt="شعار جامعة الحواش" class="h-24 w-auto">
            </div>
            <h1 class="text-5xl font-bold leading-tight mb-4">
                منصة لإدارة الفعاليات والأنشطة الجامعية
            </h1>
            <p class="text-xl max-w-2xl mx-auto opacity-90">
                اكتشف وشارك وأحضر أجمل الفعاليات في جامعة الحواش
            </p>
            <div class="mt-10">
                <a href="#upcoming"
                    class="inline-flex items-center gap-3 bg-white text-[#355872] font-semibold px-8 py-4 rounded-2xl hover:bg-[#F7F8F0] transition text-lg">
                    استعرض الفعاليات القادمة
                    <span class="text-2xl">↓</span>
                </a>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 py-16">

        <!-- الفعاليات القادمة قريباً -->
        <div id="upcoming" class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-[#355872] dark:text-[#DFD0B8]">الفعاليات القادمة قريباً</h2>
                <a href="{{ route('eventIndex') }}" class="text-[#7AAACE] hover:underline flex items-center gap-1">
                    مشاهدة الكل <span class="text-xl">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($upcomingEvents as $event)
                    <div onclick="window.location.href='{{ route('eventShow', $event) }}'"
                        class="group bg-white dark:bg-[#393E46] rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all cursor-pointer border border-transparent hover:border-[#9CD5FF]">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                class="w-full h-56 object-cover group-hover:scale-105 transition-transform">
                            <div
                                class="absolute top-4 left-4 bg-[#7AAACE] text-white text-xs font-bold px-4 py-1 rounded-2xl">
                                {{ $event->start_date->format('d M') }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-semibold text-xl text-[#355872] dark:text-[#DFD0B8] line-clamp-2 mb-2">
                                {{ $event->title }}
                            </h3>
                            <p class="text-[#948979] text-sm mb-4 line-clamp-3">
                                {{ Str::limit($event->description, 110) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-xs bg-[#F7F8F0] dark:bg-[#222831] px-4 py-2 rounded-2xl text-[#355872] dark:text-[#DFD0B8]">
                                    {{ $event->faculty->name ?? 'جامعة الحواش' }}
                                </span>
                                <span class="text-[#7AAACE] text-sm font-medium">تفاصيل ←</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-[#948979]">
                        لا توجد فعاليات قادمة حالياً
                    </div>
                @endforelse
            </div>
        </div>

        <!-- الفعاليات التي حدثت مؤخراً -->
        <div>
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-[#355872] dark:text-[#DFD0B8]">الفعاليات التي حدثت مؤخراً</h2>
                <a href="{{ route('events.archive') }}" class="text-[#7AAACE] hover:underline flex items-center gap-1">
                    الأرشيف الكامل <span class="text-xl">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($recentEvents as $event)
                    <div onclick="window.location.href='{{ route('eventShow', $event) }}'"
                        class="group bg-white dark:bg-[#393E46] rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all cursor-pointer border border-transparent hover:border-[#9CD5FF]">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                class="w-full h-56 object-cover group-hover:scale-105 transition-transform">
                            <div
                                class="absolute top-4 left-4 bg-emerald-500 text-white text-xs font-bold px-4 py-1 rounded-2xl">
                                انتهت
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-semibold text-xl text-[#355872] dark:text-[#DFD0B8] line-clamp-2 mb-2">
                                {{ $event->title }}
                            </h3>
                            <p class="text-[#948979] text-sm mb-4 line-clamp-3">
                                {{ Str::limit($event->description, 110) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-xs bg-[#F7F8F0] dark:bg-[#222831] px-4 py-2 rounded-2xl text-[#355872] dark:text-[#DFD0B8]">
                                    {{ $event->faculty->name ?? 'جامعة الحواش' }}
                                </span>
                                <span class="text-[#7AAACE] text-sm font-medium">تفاصيل ←</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-[#948979]">
                        لا توجد فعاليات حديثة بعد
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-main-layout>
