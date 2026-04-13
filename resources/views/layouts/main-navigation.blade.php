<nav x-data="{ open: false }" class="bg-[#F7F8F0] dark:bg-[#222831] border-b border-[#9CD5FF] dark:border-[#948979]"
    dir="rtl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- شعار الجامعة + عنوان المنصة -->
                <div class="shrink-0 flex items-center gap-4">
                    <a href="/">
                        <img src="{{ asset('logos/HPU.png') }}" alt="شعار جامعة الحواش"
                            class="h-12 w-auto object-contain">
                    </a>
                    <div class="hidden sm:block">
                        <h1 class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">منصة لإدارة الفعاليات
                            والأنشطة الجامعية</h1>
                    </div>
                </div>

                <!-- القوائم المطلوبة من المشرف -->
                <div class="hidden space-x-reverse space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('faculties.index')">الكليات</x-nav-link>
                    <x-nav-link :href="route('events.types')">الفعاليات</x-nav-link>
                    <x-nav-link :href="route('events.archive')">الأرشيف</x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                @auth
                    <x-nav-link :href="route('dashboard')">لوحة التحكم</x-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 font-medium transition px-3">
                            تسجيل الخروج
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-[#355872] dark:text-[#DFD0B8] hover:underline">تسجيل
                        الدخول</a>
                    <a href="{{ route('register') }}"
                        class="bg-[#7AAACE] text-white px-4 py-2 rounded-lg hover:bg-[#355872] transition">التسجيل</a>
                @endauth

                <!-- تبديل الثيم -->
                <button @click="darkMode = !darkMode" class="p-2 text-[#355872] dark:text-[#DFD0B8]">
                    <span x-show="!darkMode">🌙</span>
                    <span x-show="darkMode">☀️</span>
                </button>
            </div>

            <!-- زر القائمة في الموبايل -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-[#355872] dark:text-[#DFD0B8] hover:bg-[#9CD5FF] transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- القائمة المتجاوبة (موبايل) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('faculties.index')">الكليات</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('events.types')">الفعاليات</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('events.archive')">الأرشيف</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')">التسجيل</x-responsive-nav-link>
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-[#9CD5FF] dark:border-[#948979]">
                <div class="px-4">
                    <div class="font-medium text-base text-[#355872] dark:text-[#DFD0B8]">{{ Auth::user()->name }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')">لوحة التحكم</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            تسجيل الخروج
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
