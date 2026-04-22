<x-main-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <h1 class="text-3xl font-semibold text-[#355872] lg:text-4xl dark:text-[#DFD0B8]">
                @if (request('faculty_id'))
                    فعاليات {{ optional(\App\Models\Faculty::find(request('faculty_id')))->name ?? 'غير محددة' }}
                @elseif(request('type'))
                    فعاليات {{ $types[request('type')] ?? 'جميع الفعاليات' }}
                @else
                    الفعاليات
                @endif
            </h1>

            @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <a href="{{ route('events.create') }}"
                    class="flex items-center gap-2 px-6 py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-2xl font-medium transition">
                    <span class="text-xl">+</span> إضافة فعالية جديدة
                </a>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($events as $event)
                <div
                    class="bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl overflow-hidden shadow hover:shadow-2xl transition-all border border-[#9CD5FF] dark:border-[#948979]">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                        class="w-full h-56 object-cover">
                    <div class="p-6">
                        <a href="{{ route('eventShow', $event->id) }}"
                            class="text-xl font-semibold text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] line-clamp-2">{{ $event->title }}</a>
                        <div class="mt-4 flex items-center gap-2">
                            <span
                                class="text-xs bg-[#7AAACE] text-white px-4 py-2 rounded-2xl">{{ $event->faculty->name ?? 'غير محدد' }}</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-5">
                            @foreach ($event->tags as $tag)
                                <span
                                    class="text-xs px-3 py-1 bg-[#9CD5FF] dark:bg-[#948979] rounded-full">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-[#948979]">لا توجد فعاليات حالياً</div>
            @endforelse
        </div>

        <div class="mt-12 flex justify-center">{{ $events->links() }}</div>
    </div>
</x-main-layout>
