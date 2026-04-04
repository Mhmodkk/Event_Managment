<x-main-layout>
    <section class="bg-[#F7F8F0] dark:bg-[#222831]">
        <div class="container px-6 py-10 mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <h1 class="text-3xl font-semibold text-[#355872] capitalize lg:text-4xl dark:text-[#DFD0B8]">All Events
                </h1>

                <form action="{{ route('eventIndex') }}" method="GET" class="mt-4 md:mt-0">
                    <select name="faculty_id" onchange="this.form.submit()"
                        class="block w-full px-4 py-2 text-[#355872] bg-[#F7F8F0] border border-[#9CD5FF] rounded-md dark:bg-[#393E46] dark:text-[#DFD0B8] dark:border-[#948979] focus:border-[#7AAACE] focus:outline-none focus:ring">
                        <option value="">Filter by Faculty</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}"
                                {{ request('faculty_id') == $faculty->id ? 'selected' : '' }}>
                                {{ $faculty->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @forelse ($events as $event)
                    <div
                        class="lg:flex bg-[#F7F8F0] dark:bg-[#393E46] rounded-md overflow-hidden shadow-sm hover:shadow-md transition relative">
                        @if (auth()->check() && $event->faculty_id == auth()->user()->faculty_id)
                            <div
                                class="absolute top-0 right-0 bg-[#7AAACE] text-white text-[10px] px-2 py-1 rounded-bl-md z-10 font-bold uppercase">
                                My Faculty
                            </div>
                        @endif

                        <img class="object-cover w-full h-56 lg:w-64" src="{{ asset('/storage/' . $event->image) }}"
                            alt="{{ $event->title }}">

                        <div class="flex flex-col justify-between py-6 lg:mx-6 w-full px-4">
                            <div>
                                <a href="{{ route('eventShow', $event->id) }}"
                                    class="text-xl font-semibold text-[#355872] hover:underline dark:text-[#DFD0B8]">
                                    {{ $event->title }}
                                </a>

                                <div class="mt-2 flex items-center">
                                    <span class="text-xs text-white bg-[#7AAACE] px-2 py-1 rounded-md">
                                        {{ $event->faculty->name }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach ($event->tags as $tag)
                                    <span
                                        class="text-[10px] px-2 py-1 bg-[#9CD5FF] dark:bg-[#948979] dark:text-[#222831] rounded-md">
                                        #{{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center">
                        <p class="text-[#948979]">No events found matching your criteria.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $events->links() }}
            </div>
        </div>
    </section>
</x-main-layout>
