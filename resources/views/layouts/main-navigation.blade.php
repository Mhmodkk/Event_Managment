<nav x-data="{ mobileMenuOpen: false }"
    class="bg-[#F7F8F0] dark:bg-[#222831] border-b border-[#9CD5FF] dark:border-[#948979] sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo & Title -->
            <div class="flex items-center gap-4">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('logos/HPU.png') }}" alt="شعار جامعة الحواش" class="h-12 w-auto object-contain">
                </a>
                <div class="hidden md:block">
                    <h1 class="text-xl font-bold text-[#355872] dark:text-[#DFD0B8]">منصة لإدارة الفعاليات والأنشطة
                        الجامعية</h1>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-4 rtl:gap-4">

                <!-- 🔹 قائمة الكليات -->
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open"
                        class="flex items-center gap-1.5 px-3 py-2 text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/30 rounded-xl transition-all duration-200">
                        <span>الكليات</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200"
                            :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu - مع دعم كامل لـ RTL -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute start-0 mt-2 w-72 bg-white dark:bg-[#393E46] shadow-2xl rounded-2xl py-2 z-50 border border-[#9CD5FF] dark:border-[#948979] overflow-hidden">

                        <div class="px-4 py-2 border-b border-[#9CD5FF]/30 dark:border-[#948979]/30">
                            <span class="text-xs font-bold text-[#948979] uppercase tracking-wider">اختر الكلية</span>
                        </div>

                        <div class="max-h-80 overflow-y-auto">
                            @forelse($faculties as $faculty)
                                <a href="{{ route('eventIndex', ['faculty_id' => $faculty->id]) }}"
                                    @click="open = false"
                                    class="flex items-center gap-3 px-5 py-3 hover:bg-[#F7F8F0] dark:hover:bg-[#9CD5FF]/20 text-[#355872] dark:text-[#DFD0B8] text-sm font-medium transition group">
                                    <span
                                        class="w-2 h-2 rounded-full bg-[#9CD5FF] group-hover:bg-[#7AAACE] transition"></span>
                                    {{ $faculty->name }}
                                </a>
                            @empty
                                <div class="px-5 py-4 text-[#948979] text-sm text-center">لا توجد كليات بعد</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- 🔹 قائمة أنواع الفعاليات -->
                <div class="relative" x-data="{ eventsOpen: false }" @click.away="eventsOpen = false">
                    <button @click="eventsOpen = !eventsOpen"
                        class="flex items-center gap-1.5 px-3 py-2 text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/30 rounded-xl transition-all duration-200">
                        <span>الفعاليات</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200"
                            :class="{ 'rotate-180': eventsOpen }" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="eventsOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute start-0 mt-2 w-72 bg-white dark:bg-[#393E46] shadow-2xl rounded-2xl py-2 z-50 border border-[#9CD5FF] dark:border-[#948979] overflow-hidden">

                        <div class="px-4 py-2 border-b border-[#9CD5FF]/30 dark:border-[#948979]/30">
                            <span class="text-xs font-bold text-[#948979] uppercase tracking-wider">تصفح حسب
                                النوع</span>
                        </div>

                        <div class="grid grid-cols-2 gap-1 p-2">
                            @php
                                $eventTypes = [
                                    'workshop' => '🛠️ ورشة',
                                    'lecture' => '🎓 محاضرة',
                                    'seminar' => '💬 ندوة',
                                    'competition' => '🏆 مسابقة',
                                    'exhibition' => '🖼️ معرض',
                                    'conference' => '🎤 مؤتمر',
                                    'cultural' => '🎭 ثقافي',
                                    'sports' => '⚽ رياضي',
                                    'charity' => '🤝 خيري',
                                    'other' => '✨ أخرى',
                                ];
                            @endphp
                            @foreach ($eventTypes as $type => $name)
                                <a href="{{ route('eventIndex', ['type' => $type]) }}" @click="eventsOpen = false"
                                    class="px-4 py-2.5 hover:bg-[#F7F8F0] dark:hover:bg-[#9CD5FF]/20 text-[#355872] dark:text-[#DFD0B8] text-xs font-medium rounded-lg transition text-center">
                                    {{ $name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 🔹 روابط عادية مع فاصل بصري -->
                <div class="w-px h-6 bg-[#9CD5FF]/40 dark:bg-[#948979]/40 mx-1"></div>

                <a href="{{ route('events.archive') }}"
                    class="px-3 py-2 text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/30 rounded-xl transition-all duration-200 {{ request()->routeIs('events.archive') ? 'text-[#7AAACE] font-bold bg-[#9CD5FF]/30' : '' }}">
                    الأرشيف
                </a>

                <a href="{{ route('dashboard') }}"
                    class="px-3 py-2 text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/30 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'text-[#7AAACE] font-bold bg-[#9CD5FF]/30' : '' }}">
                    لوحة التحكم
                </a>

                <!-- 🔹 أزرار الإجراءات -->
                <div class="flex items-center gap-2 me-2">
                    @guest
                        <a href="{{ route('register') }}"
                            class="px-5 py-2.5 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-xl font-medium transition shadow-md hover:shadow-lg transform hover:scale-[1.02]">
                            حساب طالب
                        </a>
                        <a href="{{ route('admin.register') }}"
                            class="px-5 py-2.5 border-2 border-[#7AAACE] text-[#7AAACE] hover:bg-[#7AAACE] hover:text-white rounded-xl font-medium transition shadow-sm hover:shadow-md">
                            حساب مشرف
                        </a>
                    @endguest
                </div>
            </div>

            <!-- Right Side (Auth & Dark Mode) -->
            <div class="flex items-center gap-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-sm text-red-600 dark:text-red-400 hover:text-red-700 transition">تسجيل
                            الخروج</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE] transition">تسجيل
                        الدخول</a>
                @endauth

                <button @click="darkMode = !darkMode"
                    class="p-2 rounded-full bg-[#9CD5FF] dark:bg-[#948979] hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] transition duration-200">
                    <span x-show="!darkMode" class="text-xl">🌙</span>
                    <span x-show="darkMode" class="text-xl">☀️</span>
                </button>

                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden p-2 rounded-lg hover:bg-[#9CD5FF] dark:hover:bg-[#948979] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path :class="{ 'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-[#F7F8F0] dark:bg-[#222831] border-t border-[#9CD5FF] dark:border-[#948979]">
        <div class="px-4 py-4 space-y-3">
            @forelse($faculties as $faculty)
                <a href="{{ route('eventIndex', ['faculty_id' => $faculty->id]) }}"
                    class="block py-2 text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE]">•
                    {{ $faculty->name }}</a>
            @empty
                <span class="block py-2 text-[#948979] text-sm">لا توجد كليات</span>
            @endforelse
            <a href="{{ route('events.types') }}"
                class="block py-2 text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE]">الفعاليات</a>
            <a href="{{ route('events.archive') }}"
                class="block py-2 text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE]">الأرشيف</a>
            @guest
                <a href="{{ route('register') }}"
                    class="block py-2 text-[#355872] dark:text-[#DFD0B8] font-medium hover:text-[#7AAACE]">التسجيل</a>
            @endguest
        </div>
    </div>
</nav>
