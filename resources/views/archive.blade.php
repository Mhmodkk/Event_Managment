<x-main-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-[#355872] dark:text-[#DFD0B8] tracking-tight">الأرشيف</h1>
            <div class="mt-2 h-1 w-20 bg-[#7AAACE] rounded-full"></div>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse ($events as $event)
                <div
                    class="group relative bg-[#F7F8F0] dark:bg-[#393E46] rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-[#9CD5FF] dark:border-[#948979] hover:border-[#7AAACE] flex flex-col lg:flex-row">
                    <!-- Image -->
                    <div class="relative overflow-hidden lg:w-64 flex-shrink-0">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                            class="w-full h-56 lg:h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col justify-between p-6 w-full">
                        <div class="space-y-4">
                            <a href="{{ route('eventShow', $event->id) }}"
                                class="block text-xl font-bold text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] transition-colors duration-300 line-clamp-2">
                                {{ $event->title }}
                            </a>
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-xs font-medium bg-[#7AAACE] text-white px-3 py-1.5 rounded-full shadow-sm">
                                    {{ $event->faculty->name }}
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 mt-4">
                            @foreach ($event->tags as $tag)
                                <span
                                    class="text-xs px-3 py-1.5 bg-[#9CD5FF] dark:bg-[#948979] dark:text-[#222831] rounded-full font-medium shadow-sm transition-transform duration-200 group-hover:scale-105">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full text-center py-16 bg-[#F7F8F0] dark:bg-[#393E46] rounded-2xl border border-[#9CD5FF] dark:border-[#948979] shadow-sm">
                    <svg class="w-16 h-16 mx-auto text-[#948979] mb-4 opacity-60" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    <p class="text-[#948979] dark:text-[#948979] text-lg font-medium">لا توجد فعاليات سابقة في الأرشيف
                        حالياً</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if (method_exists($events, 'links'))
            <div class="mt-12 flex justify-center">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</x-main-layout>
