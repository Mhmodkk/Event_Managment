<x-main-layout>
    <section class="bg-[#F7F8F0] dark:bg-[#222831]">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-[#355872] lg:text-4xl dark:text-[#DFD0B8] mb-8">الأرشيف</h1>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                @forelse ($events as $event)
                    <div
                        class="lg:flex bg-[#F7F8F0] dark:bg-[#393E46] rounded-md overflow-hidden shadow-sm hover:shadow-md transition">
                        <img class="object-cover w-full h-56 lg:w-64" src="{{ asset('/storage/' . $event->image) }}"
                            alt="{{ $event->title }}">
                        <div class="flex flex-col justify-between py-6 lg:mx-6 w-full px-4">
                            <div>
                                <a href="{{ route('eventShow', $event->id) }}"
                                    class="text-xl font-semibold text-[#355872] hover:underline dark:text-[#DFD0B8]">
                                    {{ $event->title }}
                                </a>
                                <div class="mt-2 flex items-center">
                                    <span
                                        class="text-xs text-white bg-[#7AAACE] px-2 py-1 rounded-md">{{ $event->faculty->name }}</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach ($event->tags as $tag)
                                    <span
                                        class="text-[10px] px-2 py-1 bg-[#9CD5FF] dark:bg-[#948979] dark:text-[#222831] rounded-md">#{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-[#948979]">لا توجد فعاليات سابقة في الأرشيف حالياً
                    </div>
                @endforelse
            </div>

            @if (method_exists($events, 'links'))
                <div class="mt-12">{{ $events->links() }}</div>
            @endif
        </div>
    </section>
</x-main-layout>
