<x-main-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-blue-700">{{ $event->title }}</h1>
                <div class="flex items-center mt-2 text-indigo-600 dark:text-indigo-400 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $event->start_date->format('d/m/Y') }} | {{ $event->start_time }}
                </div>
            </div>

            @auth
                @unless (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                    <div class="flex items-center space-x-3 rtl:space-x-reverse" x-data="interactionHandler()">
                        <button @click="toggle('like')"
                            :class="liked ? 'bg-red-500 text-white' :
                                'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                            class="p-3 rounded-full transition-all duration-300 transform hover:scale-110 shadow-md">
                            <svg class="w-6 h-6" :fill="liked ? 'currentColor' : 'none'" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>

                        <button @click="toggle('save')"
                            :class="saved ? 'bg-yellow-500 text-white' :
                                'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                            class="p-3 rounded-full transition-all duration-300 transform hover:scale-110 shadow-md">
                            <svg class="w-6 h-6" :fill="saved ? 'currentColor' : 'none'" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>

                        <button @click="toggle('attending')"
                            :class="attending ? 'bg-green-600 text-white' : 'bg-indigo-600 text-white'"
                            class="px-6 py-3 rounded-lg font-bold shadow-lg transition-all hover:opacity-90">
                            <span x-text="attending ? '✓ Attending' : 'Book My Spot'"></span>
                        </button>
                    </div>
                @else
                    <div class="px-6 py-3 bg-gray-500 text-white rounded-lg font-bold shadow-lg text-center">
                        لا يمكن للمدراء تسجيل حضور
                    </div>
                @endunless
            @endauth
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                    <img src="{{ asset('/storage/' . $event->image) }}"
                        class="w-full h-[500px] object-cover transition-transform duration-500 group-hover:scale-105"
                        alt="{{ $event->title }}">
                    <div class="absolute top-4 left-4">
                        <span
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold uppercase tracking-wider">
                            {{ $event->faculty->name }}
                        </span>
                    </div>
                </div>

                <!-- Description Section -->
                <div
                    class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">تفاصيل الفعالية</h2>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                        {{ $event->description }}
                    </p>

                    <!-- الحقول الجديدة -->
                    <div
                        class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-1">نوع الفعالية</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ ucfirst($event->type) }}</p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-1">المكان</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $event->location ?? 'غير محدد' }}</p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-1">مفتوحة للجمهور</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                {{ $event->is_public ? 'نعم' : 'لا (داخلية فقط)' }}</p>
                        </div>

                        @if ($event->excluded_days && count(json_decode($event->excluded_days, true)) > 0)
                            <div class="md:col-span-2">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">أيام العطل المستثناة</h3>
                                <ul class="list-disc list-inside text-gray-600 dark:text-gray-300">
                                    @foreach (json_decode($event->excluded_days, true) as $day)
                                        <li>{{ \Carbon\Carbon::parse($day)->format('d/m/Y') }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <!-- Tags Section -->
                    <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">التصنيفات</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($event->tags as $tag)
                                <span
                                    class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full text-sm">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                @auth
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                        <!-- Comment Form -->
                        <form action="{{ route('events.comments', $event->id) }}" method="POST" class="mb-6">
                            @csrf
                            <div class="flex gap-2">
                                <input type="text" name="content" id="content" placeholder="Write your comment..."
                                    class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                <button type="submit"
                                    class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                                    Post
                                </button>
                            </div>
                        </form>

                        <!-- Comments List -->
                        <div class="space-y-4">
                            @forelse($event->comments()->latest()->get() as $comment)
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                                            <div class="flex-shrink-0">
                                                <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $comment->user->name }}</h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $comment->content }}
                                                </p>
                                            </div>
                                        </div>

                                        @can('view', $comment)
                                            <form action="{{ route('events.comments.destroy', [$event->id, $comment->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No comments yet. Be the first
                                    to comment!</p>
                            @endforelse
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">
                <!-- Location Card -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xl font-bold mb-4 dark:text-white">Location Details</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-indigo-500 mr-3 rtl:ml-3 rtl:mr-0 mt-1 flex-shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="font-semibold dark:text-white">{{ $event->location ?? 'غير محدد' }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $event->faculty->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Card -->
                <div
                    class="bg-indigo-50 dark:bg-indigo-900/20 p-6 rounded-2xl border border-indigo-100 dark:border-indigo-800">
                    <h3 class="text-lg font-bold text-indigo-900 dark:text-indigo-300 mb-2">Admin Information</h3>
                    <p class="text-indigo-800 dark:text-indigo-400">
                        Created by: <span class="font-bold">{{ $event->user->name }}</span>
                    </p>
                </div>

                <!-- QR Code Card -->
                @if ($event->qr_code)
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 text-center">
                        <h3 class="text-xl font-bold mb-4 dark:text-white">رمز الحضور (QR)</h3>
                        <img src="{{ asset('storage/' . $event->qr_code) }}" alt="QR Code"
                            class="mx-auto w-48 h-48 object-contain border-4 border-indigo-500 rounded-lg">
                        <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                            امسح الكود عند الوصول
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Alpine.js Component -->
    <script>
        function interactionHandler() {
            return {
                liked: {{ $like ? 'true' : 'false' }},
                saved: {{ $savedEvent ? 'true' : 'false' }},
                attending: {{ $attending ? 'true' : 'false' }},
                toggle(type) {
                    let url = '';
                    if (type === 'like') url = `/events-like/{{ $event->id }}`;
                    if (type === 'save') url = `/events-saved/{{ $event->id }}`;
                    if (type === 'attending') url = `/events-attending/{{ $event->id }}`;

                    axios.post(url).then(res => {
                        if (type === 'like') this.liked = !this.liked;
                        if (type === 'save') this.saved = !this.saved;
                        if (type === 'attending') this.attending = !this.attending;
                    });
                }
            }
        }
    </script>
</x-main-layout>
