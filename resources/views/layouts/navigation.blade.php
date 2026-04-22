<nav x-data="{ open: false }" class="bg-[#F7F8F0] dark:bg-[#222831] border-b border-[#9CD5FF] dark:border-[#948979]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('logos/HPU.png') }}" alt="شعار جامعة الحواش" class="h-9 w-auto object-contain">
                    </a>
                </div>

                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex rtl:space-x-reverse">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] dark:hover:text-[#7AAACE] font-medium">لوحة
                        التحكم</x-nav-link>

                    @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                        <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')"
                            class="text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] dark:hover:text-[#7AAACE] font-medium">فعالياتي</x-nav-link>
                    @endif

                    <x-nav-link :href="route('eventIndex')" :active="request()->routeIs('eventIndex') || request()->is('/') || request()->is('e')"
                        class="text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] dark:hover:text-[#7AAACE] font-medium">استعراض
                        الفعاليات</x-nav-link>

                    <x-nav-link :href="route('galleries.index')" :active="request()->routeIs('galleries.*')"
                        class="text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] dark:hover:text-[#7AAACE] font-medium">المعرض</x-nav-link>

                    @auth
                        @if (auth()->user()->isSuperAdmin())
                            <x-nav-link :href="route('managment')" :active="request()->routeIs('managment')"
                                class="text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] dark:hover:text-[#7AAACE] font-medium">الإدارة</x-nav-link>
                        @endif

                        @if (auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin())
                            <x-nav-link :href="route('scan')" :active="request()->routeIs('scan')"
                                class="text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] dark:hover:text-[#7AAACE] font-medium">مسح
                                رمز QR</x-nav-link>
                        @endif
                    @endauth

                    @if (!auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin())
                        <x-nav-link :href="route('likedEvents')" :active="request()->routeIs('likedEvents')"
                            class="text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] dark:hover:text-[#7AAACE] font-medium">المفضلة</x-nav-link>
                        <x-nav-link :href="route('savedEvents')" :active="request()->routeIs('savedEvents')"
                            class="text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] dark:hover:text-[#7AAACE] font-medium">المحفوظة</x-nav-link>
                        <x-nav-link :href="route('attendingEvents')" :active="request()->routeIs('attendingEvents')"
                            class="text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] dark:hover:text-[#7AAACE] font-medium">المشاركات</x-nav-link>
                        <x-nav-link :href="route('my.bookings')" :active="request()->routeIs('my.bookings')"
                            class="text-[#355872] hover:text-[#7AAACE] dark:text-[#DFD0B8] dark:hover:text-[#7AAACE] font-medium">حجوزاتي</x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4 rtl:space-x-reverse">
                <button @click="darkMode = !darkMode"
                    class="p-2 rounded-full bg-[#9CD5FF] dark:bg-[#948979] hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] transition duration-200">
                    <span x-show="!darkMode" class="text-xl">🌙</span>
                    <span x-show="darkMode" class="text-xl">☀️</span>
                </button>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-[#9CD5FF] dark:border-[#948979] text-sm leading-4 font-medium rounded-md text-[#948979] bg-[#F7F8F0] dark:bg-[#393E46] hover:text-[#355872] dark:hover:text-[#DFD0B8] focus:outline-none transition ease-in-out duration-150">
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
                        <x-dropdown-link :href="route('profile.edit')">الملف الشخصي</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">تسجيل
                                الخروج</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-[#948979] dark:text-[#948979] hover:text-[#355872] dark:hover:text-[#DFD0B8] hover:bg-[#9CD5FF] dark:hover:bg-[#948979] focus:outline-none focus:bg-[#9CD5FF] dark:focus:bg-[#948979] focus:text-[#355872] dark:focus:text-[#DFD0B8] transition duration-150 ease-in-out">
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

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">لوحة التحكم</x-responsive-nav-link>
            @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')">فعالياتي</x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('eventIndex')">استعراض الفعاليات</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('galleries.index')">المعرض</x-responsive-nav-link>
            @if (!auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin())
                <x-responsive-nav-link :href="route('likedEvents')">المفضلة</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('savedEvents')">المحفوظة</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('attendingEvents')">المشاركات</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('my.bookings')">حجوزاتي</x-responsive-nav-link>
            @endif
        </div>
        <div class="pt-4 pb-1 border-t border-[#9CD5FF] dark:border-[#948979]">
            <div class="px-4">
                <div class="font-medium text-base text-[#355872] dark:text-[#DFD0B8]">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-[#948979]">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">الملف الشخصي</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">تسجيل
                        الخروج</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
