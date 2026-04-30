<nav x-data="{ open: false }" class="bg-[#F7F8F0] dark:bg-[#222831] border-b border-[#9CD5FF] dark:border-[#948979]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo Section -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('logos/HPU.png') }}" alt="شعار جامعة الحواش" class="h-9 w-auto object-contain">
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex rtl:space-x-reverse">

                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                              {{ request()->routeIs('dashboard')
                                  ? 'border-[#7AAACE] text-[#7AAACE] dark:text-[#7AAACE]'
                                  : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                        لوحة التحكم
                    </a>

                    @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                        <a href="{{ route('events.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                                  {{ request()->routeIs('events.*')
                                      ? 'border-[#7AAACE] text-[#7AAACE] dark:text-[#7AAACE]'
                                      : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                            فعالياتي
                        </a>
                    @endif

                    <a href="{{ route('eventIndex') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                              {{ request()->routeIs('eventIndex') || request()->is('/') || request()->is('e')
                                  ? 'border-[#7AAACE] text-[#7AAACE] dark:text-[#7AAACE]'
                                  : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                        استعراض الفعاليات
                    </a>

                    <a href="{{ route('galleries.index') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                              {{ request()->routeIs('galleries.*')
                                  ? 'border-[#7AAACE] text-[#7AAACE] dark:text-[#7AAACE]'
                                  : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                        المعرض
                    </a>

                    @auth
                        @if (auth()->user()->isSuperAdmin())
                            <a href="{{ route('managment') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                                      {{ request()->routeIs('managment')
                                          ? 'border-[#7AAACE] text-[#7AAACE] dark:text-[#7AAACE]'
                                          : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                                الإدارة
                            </a>
                        @endif

                        @if (auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin())
                            <a href="{{ route('scan.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                                      {{ request()->routeIs('scan')
                                          ? 'border-[#7AAACE] text-[#7AAACE] dark:text-[#7AAACE]'
                                          : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                                مسح رمز QR
                            </a>
                        @endif
                    @endauth

                    @if (!auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin())
                        <a href="{{ route('likedEvents') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                                  {{ request()->routeIs('likedEvents')
                                      ? 'border-[#7AAACE] text-[#7AAACE] dark:text-[#7AAACE]'
                                      : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                            المفضلة
                        </a>
                        <a href="{{ route('savedEvents') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                                  {{ request()->routeIs('savedEvents')
                                      ? 'border-[#7AAACE] text-[#7AAACE] dark:text-[#7AAACE]'
                                      : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                            المحفوظة
                        </a>
                        <a href="{{ route('attendingEvents') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                                  {{ request()->routeIs('attendingEvents')
                                      ? 'border-[#7AAACE] text-[#7AAACE] dark:text-[#7AAACE]'
                                      : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                            المشاركات
                        </a>
                        <a href="{{ route('my.bookings') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                                  {{ request()->routeIs('my.bookings')
                                      ? 'border-[#7AAACE] text-[#7AAACE] dark:text-[#7AAACE]'
                                      : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                            حجوزاتي
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right Side: Dark Mode + User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4 rtl:space-x-reverse">

                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode"
                    class="p-2 rounded-full bg-[#9CD5FF] dark:bg-[#948979] hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] text-[#355872] dark:text-[#DFD0B8] transition duration-200">
                    <span x-show="!darkMode" class="text-xl">🌙</span>
                    <span x-show="darkMode" class="text-xl">☀️</span>
                </button>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-[#9CD5FF] dark:border-[#948979] text-sm leading-4 font-medium rounded-md text-[#355872] dark:text-[#DFD0B8] bg-[#F7F8F0] dark:bg-[#393E46] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] focus:outline-none transition duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 transition">الملف
                            الشخصي</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 transition">تسجيل
                                الخروج</a>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] dark:hover:text-[#7AAACE] hover:bg-[#9CD5FF] dark:hover:bg-[#948979] focus:outline-none transition duration-150">
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

    <!-- Responsive Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-[#F7F8F0] dark:bg-[#222831] border-t border-[#9CD5FF] dark:border-[#948979]">
        <div class="pt-2 pb-3 space-y-1 px-4">

            <a href="{{ route('dashboard') }}"
                class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors
                      {{ request()->routeIs('dashboard')
                          ? 'border-[#7AAACE] text-[#7AAACE] bg-[#9CD5FF]/20 dark:bg-[#948979]/20'
                          : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/20 hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                لوحة التحكم
            </a>

            @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <a href="{{ route('events.index') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors
                          {{ request()->routeIs('events.*')
                              ? 'border-[#7AAACE] text-[#7AAACE] bg-[#9CD5FF]/20 dark:bg-[#948979]/20'
                              : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/20 hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                    فعالياتي
                </a>
            @endif

            <a href="{{ route('eventIndex') }}"
                class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors
                      {{ request()->routeIs('eventIndex') || request()->is('/') || request()->is('e')
                          ? 'border-[#7AAACE] text-[#7AAACE] bg-[#9CD5FF]/20 dark:bg-[#948979]/20'
                          : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/20 hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                استعراض الفعاليات
            </a>

            <a href="{{ route('galleries.index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors
                      {{ request()->routeIs('galleries.*')
                          ? 'border-[#7AAACE] text-[#7AAACE] bg-[#9CD5FF]/20 dark:bg-[#948979]/20'
                          : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/20 hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                المعرض
            </a>

            @if (!auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin())
                <a href="{{ route('likedEvents') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors
                          {{ request()->routeIs('likedEvents')
                              ? 'border-[#7AAACE] text-[#7AAACE] bg-[#9CD5FF]/20 dark:bg-[#948979]/20'
                              : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/20 hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                    المفضلة
                </a>
                <a href="{{ route('savedEvents') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors
                          {{ request()->routeIs('savedEvents')
                              ? 'border-[#7AAACE] text-[#7AAACE] bg-[#9CD5FF]/20 dark:bg-[#948979]/20'
                              : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/20 hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                    المحفوظة
                </a>
                <a href="{{ route('attendingEvents') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors
                          {{ request()->routeIs('attendingEvents')
                              ? 'border-[#7AAACE] text-[#7AAACE] bg-[#9CD5FF]/20 dark:bg-[#948979]/20'
                              : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/20 hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                    المشاركات
                </a>
                <a href="{{ route('my.bookings') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-colors
                          {{ request()->routeIs('my.bookings')
                              ? 'border-[#7AAACE] text-[#7AAACE] bg-[#9CD5FF]/20 dark:bg-[#948979]/20'
                              : 'border-transparent text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/20 hover:border-[#9CD5FF] dark:hover:border-[#948979]' }}">
                    حجوزاتي
                </a>
            @endif
        </div>

        <!-- User Info in Mobile -->
        <div class="pt-4 pb-4 border-t border-[#9CD5FF] dark:border-[#948979] px-4">
            <div class="font-medium text-base text-[#355872] dark:text-[#DFD0B8]">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-[#948979]">{{ Auth::user()->email }}</div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-[#355872] dark:text-[#DFD0B8] hover:text-[#7AAACE] hover:bg-[#9CD5FF]/20 hover:border-[#9CD5FF] transition">الملف
                    الشخصي</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-red-600 dark:text-red-400 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 transition">تسجيل
                        الخروج</a>
                </form>
            </div>
        </div>
    </div>
</nav>
