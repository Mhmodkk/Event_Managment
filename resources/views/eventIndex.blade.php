<x-main-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">All Events</h1>

                <form action="{{ route('eventIndex') }}" method="GET" class="mt-4 md:mt-0">
                    <select name="faculty_id" onchange="this.form.submit()"
                        class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:outline-none focus:ring">
                        <option value="">Filter by Faculty</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{ request('faculty_id') == $faculty->id ? 'selected' : '' }}>
                                {{ $faculty->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @forelse ($events as $event)
                    <div class="lg:flex bg-gray-100 dark:bg-gray-800 rounded-md overflow-hidden shadow-sm hover:shadow-md transition relative">
                        @if(auth()->check() && $event->faculty_id == auth()->user()->faculty_id)
                            <div class="absolute top-0 right-0 bg-indigo-600 text-white text-[10px] px-2 py-1 rounded-bl-md z-10 font-bold uppercase">
                                My Faculty
                            </div>
                        @endif

                        <img class="object-cover w-full h-56 lg:w-64"
                            src="{{ asset('/storage/' . $event->image) }}" alt="{{ $event->title }}">

                        <div class="flex flex-col justify-between py-6 lg:mx-6 w-full px-4">
                            <div>
                                <a href="{{ route('eventShow', $event->id) }}"
                                    class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">
                                    {{ $event->title }}
                                </a>

                                <div class="mt-2 flex items-center">
                                    <span class="text-xs text-white bg-indigo-500 px-2 py-1 rounded-md">
                                        {{ $event->faculty->name }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach ($event->tags as $tag)
                                    <span class="text-[10px] px-2 py-1 bg-slate-200 dark:bg-slate-700 dark:text-gray-300 rounded-md">
                                        #{{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center">
                        <p class="text-gray-500">No events found matching your criteria.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $events->links() }}
            </div>
        </div>
    </section>
</x-main-layout>
