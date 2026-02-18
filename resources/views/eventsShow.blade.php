<x-main-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $event->title }}</h1>
                <div class="flex items-center mt-2 text-indigo-600 dark:text-indigo-400 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $event->start_date }} | {{ $event->start_time }}
                </div>
            </div>

            @auth
            <div class="flex items-center space-x-3" x-data="interactionHandler()">
                <button @click="toggle('like')" :class="liked ? 'bg-red-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'" class="p-3 rounded-full transition-all duration-300 transform hover:scale-110 shadow-md">
                    <svg class="w-6 h-6" :fill="liked ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                </button>
                <button @click="toggle('save')" :class="saved ? 'bg-yellow-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'" class="p-3 rounded-full transition-all duration-300 transform hover:scale-110 shadow-md">
                    <svg class="w-6 h-6" :fill="saved ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                </button>
                <button @click="toggle('attending')" :class="attending ? 'bg-green-600 text-white' : 'bg-indigo-600 text-white'" class="px-6 py-3 rounded-lg font-bold shadow-lg transition-all hover:opacity-90">
                    <span x-text="attending ? '✓ Attending' : 'Book My Spot'"></span>
                </button>
            </div>
            @endauth
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                    <img src="{{ asset('/storage/' . $event->image) }}" class="w-full h-[500px] object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $event->title }}">
                    <div class="absolute top-4 left-4">
                        <span class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold uppercase tracking-wider">
                            {{ $event->faculty->name }}
                        </span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">About this activity</h2>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                        {{ $event->description }}
                    </p>

                    <div class="mt-8 pt-8 border-t dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($event->tags as $tag)
                                <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full text-sm">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                @include('events.comments')
            </div>

            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xl font-bold mb-4 dark:text-white">Location Details</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-indigo-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <div>
                                <p class="font-semibold dark:text-white">{{ $event->address }}</p>
                                <p class="text-sm text-gray-500">{{ $event->city->name }}, {{ $event->country->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-indigo-50 dark:bg-indigo-900/20 p-6 rounded-2xl border border-indigo-100 dark:border-indigo-800">
                    <h3 class="text-lg font-bold text-indigo-900 dark:text-indigo-300 mb-2">Organizer Information</h3>
                    <p class="text-indigo-800 dark:text-indigo-400">Created by: <span class="font-bold">{{ $event->user->name }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function interactionHandler() {
            return {
                liked: {{ $like ? 'true' : 'false' }},
                saved: {{ $savedEvent ? 'true' : 'false' }},
                attending: {{ $attending ? 'true' : 'false' }},
                toggle(type) {
                    let url = '';
                    if(type === 'like') url = `/events-like/{{ $event->id }}`;
                    if(type === 'save') url = `/events-saved/{{ $event->id }}`;
                    if(type === 'attending') url = `/events-attending/{{ $event->id }}`;

                    axios.post(url).then(res => {
                        if(type === 'like') this.liked = !this.liked;
                        if(type === 'save') this.saved = !this.saved;
                        if(type === 'attending') this.attending = !this.attending;
                    });
                }
            }
        }
    </script>
</x-main-layout>
