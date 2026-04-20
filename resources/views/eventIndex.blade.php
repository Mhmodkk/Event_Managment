<x-main-layout>
    <section class="bg-[#F7F8F0] dark:bg-[#222831]">
        <div class="container px-6 py-10 mx-auto">

            <!-- العنوان + الفلاتر + زر الإضافة -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">

                <h1 class="text-3xl font-semibold text-[#355872] capitalize lg:text-4xl dark:text-[#DFD0B8]">
                    @if (request('faculty_id'))
                        فعاليات {{ optional(\App\Models\Faculty::find(request('faculty_id')))->name ?? 'غير محددة' }}
                    @elseif(request('type'))
                        فعاليات -
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
                        {{ $types[request('type')] ?? 'جميع الفعاليات' }}
                    @else
                        الفعاليات
                    @endif
                </h1>

                <!-- زر إضافة فعالية جديدة (يظهر للمدير والمشرف فقط) -->
                @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                    <a href="{{ route('events.create') }}"
                        class="flex items-center gap-2 px-6 py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-2xl font-medium shadow-md hover:shadow-lg transition">
                        <span class="text-xl">+</span>
                        إضافة فعالية جديدة
                    </a>
                @endif

            </div>

            <!-- باقي المحتوى (عرض الفعاليات) -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($events as $event)
                    <div
                        class="bg-[#F7F8F0] dark:bg-[#393E46] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-[#9CD5FF] dark:border-[#948979]">
                        @if (auth()->check() && $event->faculty_id == auth()->user()->faculty_id)
                            <div
                                class="absolute top-4 right-4 bg-[#7AAACE] text-white text-xs px-3 py-1 rounded-full font-bold z-10">
                                كليتي
                            </div>
                        @endif

                        <img class="w-full h-56 object-cover" src="{{ asset('storage/' . $event->image) }}"
                            alt="{{ $event->title }}">

                        <div class="p-6">
                            <a href="{{ route('eventShow', $event->id) }}"
                                class="text-xl font-semibold text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] line-clamp-2">
                                {{ $event->title }}
                            </a>

                            <div class="mt-3 flex items-center gap-2">
                                <span class="text-xs bg-[#7AAACE] text-white px-3 py-1 rounded-full">
                                    {{ $event->faculty->name ?? 'غير محدد' }}
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach ($event->tags as $tag)
                                    <span class="text-xs px-3 py-1 bg-[#9CD5FF] dark:bg-[#948979] rounded-full">
                                        #{{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <p class="text-[#948979] text-lg">لا توجد فعاليات تطابق معايير التصفية حالياً</p>
                    </div>
                @endforelse
            </div>

            <!-- الترقيم -->
            <div class="mt-12 flex justify-center">
                {{ $events->links() }}
            </div>

        </div>
    </section>
</x-main-layout>
