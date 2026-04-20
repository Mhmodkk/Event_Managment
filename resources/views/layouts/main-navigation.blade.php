<nav x-data="{ open: false }" class="bg-[#F7F8F0] dark:bg-[#222831] border-b border-[#9CD5FF] dark:border-[#948979]"
    dir="rtl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <!-- شعار + عنوان -->
            <div class="flex">
                <div class="shrink-0 flex items-center gap-4">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('logos/HPU.png') }}" alt="شعار جامعة الحواش"
                            class="h-12 w-auto object-contain">
                    </a>
                    <div class="hidden sm:block">
                        <h1 class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">
                            منصة لإدارة الفعاليات والأنشطة الجامعية
                        </h1>
                    </div>
                </div>

                <div class="hidden sm:flex items-center gap-12 ms-10"> <!-- gap-8 → gap-12 -->

                    <!-- 1. الكليات -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-1 text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE] transition-colors">
                            الكليات
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.outside="open = false"
                            class="absolute mt-2 w-80 bg-white dark:bg-[#222831] shadow-2xl rounded-2xl py-3 z-50 border border-[#9CD5FF] dark:border-[#948979]">
                            @forelse($faculties as $faculty)
                                <a href="{{ route('eventIndex', ['faculty_id' => $faculty->id]) }}"
                                    @click="open = false"
                                    class="block px-6 py-3 hover:bg-[#F7F8F0] dark:hover:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8]">
                                    {{ $faculty->name }}
                                </a>
                            @empty
                                <div class="px-6 py-3 text-[#948979]">لا توجد كليات بعد</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- 2. الفعاليات -->
                    <div class="relative" x-data="{ eventsOpen: false }">
                        <button @click="eventsOpen = !eventsOpen"
                            class="flex items-center gap-1 text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE] transition-colors">
                            الفعاليات
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="eventsOpen" @click.outside="eventsOpen = false"
                            class="absolute mt-2 w-80 bg-white dark:bg-[#222831] shadow-2xl rounded-2xl py-3 z-50 border border-[#9CD5FF] dark:border-[#948979]">
                            @php
                                $eventTypes = [
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

                            @foreach ($eventTypes as $type => $name)
                                <a href="{{ route('eventIndex', ['type' => $type]) }}" @click="eventsOpen = false"
                                    class="block px-6 py-3 hover:bg-[#F7F8F0] dark:hover:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8]">
                                    {{ $name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. الأرشيف -->
                    <a href="{{ route('events.archive') }}"
                        class="text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE] transition-colors {{ request()->routeIs('events.archive') ? 'text-[#7AAACE]' : '' }}">
                        الأرشيف
                    </a>
                    <!-- 4. التسجيل -->
                    @guest
                        <a href="{{ route('register') }}"
                            class="text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE] transition-colors">
                            التسجيل
                        </a>
                    @endguest

                </div>
            </div>

            <!-- الجانب الأيمن -->
            <div class="flex items-center gap-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-sm text-red-600 hover:text-red-700 transition">
                            تسجيل الخروج
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE]">
                        تسجيل الدخول
                    </a>
                @endauth

                <button @click="darkMode = !darkMode"
                    class="p-2 rounded-full bg-[#9CD5FF] dark:bg-[#948979] hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] transition duration-200">
                    <span x-show="!darkMode" class="text-xl">🌙</span>
                    <span x-show="darkMode" class="text-xl">☀️</span>
                </button>

                <button @click="open = !open" class="sm:hidden p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- قائمة الموبايل -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden bg-[#F7F8F0] dark:bg-[#222831] border-t">
        <div class="px-4 py-4 space-y-4">
            @forelse($faculties as $faculty)
                <a href="{{ route('eventIndex', ['faculty_id' => $faculty->id]) }}" class="block font-medium">•
                    {{ $faculty->name }}</a>
            @empty
                <span class="block text-[#948979]">لا توجد كليات</span>
            @endforelse
            <a href="{{ route('events.types') }}" class="block font-medium">الفعاليات</a>
            <a href="{{ route('events.archive') }}" class="block font-medium">الأرشيف</a>
            @guest
                <a href="{{ route('register') }}" class="block font-medium">التسجيل</a>
            @endguest
        </div>
    </div>
</nav>
