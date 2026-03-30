<x-main-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div class="space-y-2">
                <h1
                    class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-blue-600 tracking-tight">
                    {{ $event->title }}
                </h1>
                <div class="flex items-center gap-3 text-indigo-600 dark:text-indigo-400 font-medium text-lg">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ $event->start_date->format('d/m/Y') }} | {{ $event->start_time }}</span>
                </div>
            </div>

            <!-- Controls & Interaction Buttons -->
            <div class="flex flex-wrap items-center gap-5 mt-4 md:mt-0">
                @auth
                    @if (auth()->id() === $event->user_id || auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                        <a href="{{ route('events.attendance', $event->id) }}"
                            class="inline-flex items-center px-7 py-3.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02]">
                            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            إدارة الحضور ({{ $event->attendings->count() }})
                        </a>
                    @endif

                    @unless (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                        <div class="flex items-center gap-4 rtl:gap-4" x-data="interactionHandler()">
                            <!-- Like -->
                            <button @click="toggle('like')"
                                :class="liked ? 'bg-red-500 text-white shadow-red-300/50' :
                                    'bg-gray-200/80 dark:bg-gray-700/80 text-gray-700 dark:text-gray-300'"
                                class="p-3.5 rounded-full transition-all duration-300 hover:scale-110 shadow-md hover:shadow-lg">
                                <svg class="w-7 h-7" :fill="liked ? 'currentColor' : 'none'" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>

                            <!-- Save -->
                            <button @click="toggle('save')"
                                :class="saved ? 'bg-amber-500 text-white shadow-amber-300/50' :
                                    'bg-gray-200/80 dark:bg-gray-700/80 text-gray-700 dark:text-gray-300'"
                                class="p-3.5 rounded-full transition-all duration-300 hover:scale-110 shadow-md hover:shadow-lg">
                                <svg class="w-7 h-7" :fill="saved ? 'currentColor' : 'none'" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </button>

                            <!-- Attend -->
                            <button @click="toggle('attending')"
                                :class="attending ? 'bg-emerald-600 text-white shadow-emerald-300/50' :
                                    'bg-indigo-600 text-white shadow-indigo-300/50'"
                                class="px-8 py-3.5 rounded-xl font-bold text-base shadow-xl transition-all duration-300 hover:opacity-95 hover:scale-[1.03]">
                                <span x-text="attending ? '✓ مشارك' : 'احجز مكاني'"></span>
                            </button>
                        </div>
                    @endunless
                @endauth
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 xl:gap-10">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-10">
                <!-- Image -->
                <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
                    <img src="{{ asset('/storage/' . $event->image) }}"
                        class="w-full h-80 md:h-[520px] lg:h-[580px] object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                        alt="{{ $event->title }}">
                    <div class="absolute top-6 left-6">
                        <span
                            class="bg-indigo-600/95 backdrop-blur-sm text-white px-5 py-2.5 rounded-xl text-base font-bold uppercase tracking-wide shadow-lg">
                            {{ $event->faculty->name }}
                        </span>
                    </div>
                </div>

                <!-- Details -->
                <div
                    class="bg-white dark:bg-gray-800/95 p-8 lg:p-10 rounded-3xl shadow-xl border border-gray-100/50 dark:border-gray-700/50">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">تفاصيل الفعالية</h2>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg mb-10">
                        {{ $event->description }}
                    </p>

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white text-lg">نوع الفعالية</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-base">
                                {{ ucfirst($event->type ?? 'غير محدد') }}</p>
                        </div>

                        <div class="space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white text-lg">المكان</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-base">{{ $event->location ?? 'غير محدد' }}
                            </p>
                        </div>

                        <div class="space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white text-lg">مفتوحة للجمهور</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-base font-medium">
                                {{ $event->is_public ? 'نعم – مفتوحة للجميع' : 'لا – داخلية فقط' }}
                            </p>
                        </div>

                        @if ($event->excluded_days && count(json_decode($event->excluded_days, true)) > 0)
                            <div class="md:col-span-2 space-y-3">
                                <h3 class="font-semibold text-gray-900 dark:text-white text-lg">أيام العطل المستثناة
                                </h3>
                                <div class="flex flex-wrap gap-3">
                                    @foreach (json_decode($event->excluded_days, true) as $day)
                                        <span
                                            class="px-5 py-2.5 bg-gray-100 dark:bg-gray-700/60 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium shadow-sm">
                                            {{ \Carbon\Carbon::parse($day)->format('d/m/Y') }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    @if ($event->tags->isNotEmpty())
                        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-4">التصنيفات</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($event->tags as $tag)
                                    <span
                                        class="px-5 py-2.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-sm font-medium shadow-sm">
                                        #{{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Comments -->
                @auth
                    <div
                        class="bg-white dark:bg-gray-800/95 p-8 lg:p-10 rounded-3xl shadow-xl border border-gray-100/50 dark:border-gray-700/50">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">التعليقات</h2>

                        <form action="{{ route('events.comments', $event->id) }}" method="POST" class="mb-10">
                            @csrf
                            <div class="flex flex-col sm:flex-row gap-4">
                                <input type="text" name="content" placeholder="أضف تعليقك هنا..."
                                    class="flex-1 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-2xl px-6 py-4 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-base">
                                <button type="submit"
                                    class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transition transform hover:scale-[1.02] text-base">
                                    إرسال
                                </button>
                            </div>
                        </form>

                        <div class="space-y-6">
                            @forelse($event->comments()->latest()->get() as $comment)
                                <div class="bg-gray-50 dark:bg-gray-700/40 p-6 rounded-2xl shadow-sm">
                                    <div class="flex items-start justify-between gap-5">
                                        <div class="flex items-center gap-4 rtl:flex-row-reverse">
                                            <div
                                                class="w-12 h-12 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-7 h-7 text-indigo-600 dark:text-indigo-400"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 dark:text-white text-base">
                                                    {{ $comment->user->name }}</h4>
                                                <p class="mt-2 text-gray-600 dark:text-gray-300 leading-relaxed">
                                                    {{ $comment->content }}</p>
                                            </div>
                                        </div>

                                        @can('view', $comment)
                                            <form action="{{ route('events.comments.destroy', [$event->id, $comment->id]) }}"
                                                method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-medium text-sm">
                                                    حذف
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-gray-500 dark:text-gray-400 py-12 text-lg font-medium">
                                    لا توجد تعليقات بعد. كن أول من يعلق!
                                </p>
                            @endforelse
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Sidebar -->
            <div class="space-y-8 lg:space-y-10">

                <!-- تقييمات الفعالية - القسم الجديد -->
                <div
                    class="bg-white dark:bg-gray-800/95 p-8 rounded-3xl shadow-xl border border-gray-100/50 dark:border-gray-700/50">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                        تقييمات الفعالية
                        @if ($event->ratingCount() > 0)
                            <span
                                class="text-sm font-normal text-gray-500 dark:text-gray-400">({{ $event->ratingCount() }})</span>
                        @endif
                    </h3>

                    @if ($event->ratingCount() > 0)
                        <div class="flex items-center gap-4 mb-6">
                            <div class="text-5xl font-bold text-amber-500">
                                {{ number_format($event->averageRating(), 1) }}</div>
                            <div>
                                <div class="flex text-3xl text-amber-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span
                                            class="{{ $i <= round($event->averageRating()) ? 'text-amber-400' : 'text-gray-300 dark:text-gray-600' }}">★</span>
                                    @endfor
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">متوسط التقييم</p>
                            </div>
                        </div>

                        <!-- آخر تقييمين -->
                        @foreach ($event->ratings()->with('user')->latest()->take(2)->get() as $rating)
                            <div
                                class="border-t border-gray-200 dark:border-gray-700 pt-6 first:border-t-0 first:pt-0">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $rating->user->name }}
                                        </p>
                                        <div class="flex text-amber-400 text-lg mt-1">
                                            @for ($i = 1; $i <= $rating->stars; $i++)
                                                ★
                                            @endfor
                                        </div>
                                    </div>
                                    <span
                                        class="text-xs text-gray-500 dark:text-gray-400">{{ $rating->created_at->diffForHumans() }}</span>
                                </div>
                                @if ($rating->comment)
                                    <p class="mt-3 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                        "{{ $rating->comment }}"
                                    </p>
                                @endif
                            </div>
                        @endforeach

                        @if ($event->ratingCount() > 2)
                            <p class="text-center text-sm text-indigo-600 dark:text-indigo-400 mt-6">
                                +{{ $event->ratingCount() - 2 }} تقييم آخر
                            </p>
                        @endif
                    @else
                        <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                            <p class="text-lg">لم يقيّم أحد هذه الفعالية بعد</p>
                            <p class="text-sm mt-2">كن أول من يقيّم بعد حضورك!</p>
                        </div>
                    @endif
                </div>

                <!-- Location -->
                <div
                    class="bg-white dark:bg-gray-800/95 p-8 rounded-3xl shadow-xl border border-gray-100/50 dark:border-gray-700/50">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">تفاصيل المكان</h3>
                    <div class="flex items-start gap-5">
                        <svg class="w-8 h-8 text-indigo-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div class="space-y-2">
                            <p class="font-bold text-xl text-gray-900 dark:text-white">
                                {{ $event->location ?? 'غير محدد' }}</p>
                            <p class="text-gray-600 dark:text-gray-400">{{ $event->faculty->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Organizer -->
                <div
                    class="bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-950/40 dark:to-blue-950/40 p-8 rounded-3xl border border-indigo-100 dark:border-indigo-900/50 shadow-xl">
                    <h3 class="text-xl font-bold text-indigo-900 dark:text-indigo-300 mb-4">منظم الفعالية</h3>
                    <p class="text-indigo-800 dark:text-indigo-300 text-lg">
                        بواسطة: <span
                            class="font-extrabold text-indigo-950 dark:text-indigo-200">{{ $event->user->name }}</span>
                    </p>
                </div>

                <!-- QR Code الشخصي -->
                @auth
                    @if ($attending && $qrCodeUrl)
                        <div
                            class="bg-white dark:bg-gray-800/95 p-8 rounded-3xl shadow-xl border border-gray-100/50 dark:border-gray-700/50 text-center">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">رمز الحضور الخاص بك</h3>
                            <div
                                class="inline-block p-5 bg-white dark:bg-gray-900 rounded-2xl shadow-inner border-2 border-emerald-400/30">
                                <img src="{{ $qrCodeUrl }}" alt="رمز QR لحضورك"
                                    class="w-56 h-56 md:w-64 md:h-64 object-contain mx-auto">
                            </div>
                            <p class="mt-6 text-gray-600 dark:text-gray-400 text-base">
                                امسح هذا الكود عند الوصول لتسجيل حضورك
                            </p>
                        </div>
                    @elseif (!$attending)
                        <div
                            class="bg-yellow-50 dark:bg-yellow-900/30 p-8 rounded-3xl text-center border border-yellow-200 dark:border-yellow-800">
                            <p class="text-lg font-medium text-yellow-800 dark:text-yellow-300">
                                احجز مكانك أولاً ليظهر رمز QR الخاص بك
                            </p>
                        </div>
                    @endif
                @endauth

                <!-- قسم الحجز متعدد التذاكر -->
                @if ($event->num_tickets > 0)
                    <div
                        class="bg-white dark:bg-gray-800/95 p-8 rounded-3xl shadow-xl border border-gray-100/50 dark:border-gray-700/50">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">احجز مقعدك الآن</h3>

                        <form id="attending-form" class="space-y-6">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    عدد التذاكر
                                </label>
                                <div class="flex items-center gap-4">
                                    <button type="button" onclick="changeTickets(-1)"
                                        class="w-12 h-12 flex items-center justify-center text-2xl bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-xl transition">-</button>

                                    <input type="number" id="num_tickets" name="num_tickets" value="1"
                                        min="1" max="10"
                                        class="w-24 text-center text-3xl font-bold bg-transparent border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-3">

                                    <button type="button" onclick="changeTickets(1)"
                                        class="w-12 h-12 flex items-center justify-center text-2xl bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-xl transition">+</button>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                    متبقي: <span id="remaining-tickets" class="font-semibold text-green-600">
                                        {{ $event->num_tickets }}
                                    </span> مقعد
                                </p>
                            </div>

                            <button type="button" onclick="submitAttending()"
                                class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl transition text-lg">
                                حجز <span id="ticket-count">1</span> تذكرة
                            </button>
                        </form>
                    </div>
                @else
                    <div
                        class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-3xl p-8 text-center">
                        <p class="text-red-600 dark:text-red-400 font-medium">نفذت التذاكر لهذه الفعالية</p>
                    </div>
                @endif

                <!-- Guest Form -->
                @if ($event->is_public && !auth()->check())
                    <!-- باقي كود الضيف كما هو عندك بدون تغيير -->
                    <div
                        class="bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-50 dark:from-blue-950/40 dark:via-indigo-950/40 dark:to-blue-950/40 p-8 lg:p-10 rounded-3xl border border-blue-100 dark:border-blue-900/50 shadow-2xl">
                        <!-- ... كود الضيف الخاص بك ... -->
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- مودال النجاح -->
    <div id="qrSuccessModal"
        class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl max-w-md w-full text-center relative shadow-2xl">
            <button onclick="document.getElementById('qrSuccessModal').classList.add('hidden')"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-4xl font-bold leading-none">×</button>

            <h3 class="text-3xl font-bold text-green-600 dark:text-green-400 mb-6">شكراً لحجزك!</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-6 text-lg">امسح هذا الرمز عند الوصول لتسجيل حضورك</p>

            <img id="qrSuccessImage" src="" alt="رمز الحضور QR"
                class="mx-auto w-64 h-64 object-contain border-4 border-green-500 rounded-xl shadow-lg">
            <p class="mt-6 text-sm text-gray-600 dark:text-gray-400"><strong id="qrSuccessToken"
                    class="font-mono break-all"></strong></p>
        </div>
    </div>

</x-main-layout>

<!-- Scripts -->
<script>
    let currentTickets = 1;
    const maxTickets = 10;

    function changeTickets(amount) {
        currentTickets = Math.max(1, Math.min(maxTickets, currentTickets + amount));
        document.getElementById('num_tickets').value = currentTickets;
        document.getElementById('ticket-count').textContent = currentTickets;
    }

    async function submitAttending() {
        const formData = new FormData();
        formData.append('num_tickets', currentTickets);

        try {
            const response = await fetch("{{ route('events.attending', $event->id) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (data.status === 'added') {
                document.getElementById('qrSuccessImage').src = data.qr_code_url;
                document.getElementById('qrSuccessToken').textContent = data.qr_token;
                document.getElementById('qrSuccessModal').classList.remove('hidden');
            } else {
                alert(data.message || 'حدث خطأ أثناء الحجز');
            }
        } catch (error) {
            alert('فشل في الاتصال بالخادم');
        }
    }
</script>

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
                    if (type === 'attending') {
                        this.attending = !this.attending;

                        if (res.data.status === 'added' && res.data.qr_code_url) {
                            document.getElementById('qrSuccessImage').src = res.data.qr_code_url;
                            document.getElementById('qrSuccessToken').textContent = res.data.qr_token;
                            document.getElementById('qrSuccessModal').classList.remove('hidden');
                        }
                    }
                }).catch(err => console.error(err));
            }
        }
    }
</script>

<script>
    document.getElementById('guest-attend-form')?.addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const message = document.getElementById('guest-message');
        message.classList.remove('hidden', 'text-green-600', 'text-red-600');
        message.textContent = 'جاري التسجيل...';

        try {
            const response = await axios.post('{{ route('events.attending', $event->id) }}', new FormData(
                form));
            message.classList.add('text-green-600');
            message.textContent = response.data.message || 'تم تسجيل حضورك كضيف بنجاح!';
            form.reset();

            if (response.data.qr_code_url) {
                document.getElementById('qrSuccessImage').src = response.data.qr_code_url;
                document.getElementById('qrSuccessToken').textContent = response.data.qr_token;
                document.getElementById('qrSuccessModal').classList.remove('hidden');
            }
        } catch (error) {
            message.classList.add('text-red-600');
            message.textContent = error.response?.data?.error || error.response?.data?.message ||
                'حدث خطأ، حاول مرة أخرى';
        }
    });
</script>
