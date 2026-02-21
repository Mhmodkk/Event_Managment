<x-main-layout>
    <section class="bg-white dark:bg-gray-900 min-h-screen">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-slate-300">
                Latest Events
            </h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @foreach ($events as $event)
                    <div class="lg:flex bg-slate-100 dark:bg-gray-800 rounded-md overflow-hidden">
                        <img class="object-cover w-full h-56 rounded-lg lg:w-64"
                            src="{{ asset('/storage/' . $event->image) }}" alt="{{ $event->title }}">

                        <div class="flex flex-col justify-between py-6 lg:mx-6 w-full">
                            <a href="{{ route('eventShow', $event->id) }}"
                                class="text-xl font-semibold text-gray-800 hover:underline dark:text-slate-300">
                                {{ $event->title }}
                            </a>

                            <span class="text-sm text-center text-white bg-indigo-500 rounded-md p-2 w-full block">
                                {{ $event->faculty->name }}
                            </span>

                            <div class="flex flex-wrap gap-2 mt-2">
                                @foreach ($event->tags as $tag)
                                    <p
                                        class="text-sm p-1 bg-slate-200 dark:bg-slate-700 dark:text-slate-300 rounded-md">
                                        {{ $tag->name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-main-layout>
