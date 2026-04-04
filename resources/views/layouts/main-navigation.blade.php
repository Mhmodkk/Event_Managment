<nav x-data="{ open: false }" class="bg-[#F7F8F0] dark:bg-[#222831] border-b border-[#9CD5FF] dark:border-[#948979]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <img src="{{ asset('storage/logos/HPU.png') }}" alt="HPU Logo" class="h-9 w-auto object-contain">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('eventIndex')" :active="request()->routeIs('eventIndex')">
                        {{ __('Explore Events') }}
                    </x-nav-link>
                    <x-nav-link :href="route('galleryIndex')" :active="request()->routeIs('galleryIndex')">
                        {{ __('Gallery') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                @auth
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- زر تبديل الثيم -->
                    <button @click="darkMode = !darkMode"
                        class="p-2 rounded-full bg-[#9CD5FF] dark:bg-[#948979] hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] transition duration-200">
                        <span x-show="!darkMode" class="text-xl">🌙</span>
                        <span x-show="darkMode" class="text-xl">☀️</span>
                    </button>
                @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">{{ __('Login') }}</x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">{{ __('Register') }}</x-nav-link>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
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
            <x-responsive-nav-link :href="route('eventIndex')" :active="request()->routeIs('eventIndex')">
                {{ __('Explore Events') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('galleryIndex')" :active="request()->routeIs('galleryIndex')">
                {{ __('Gallery') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <div class="px-4 py-2">
                    <button @click="darkMode = !darkMode"
                        class="w-full text-left px-3 py-2 rounded-md bg-[#9CD5FF] dark:bg-[#948979] hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] transition">
                        <span x-show="!darkMode">Switch to Dark Mode 🌙</span>
                        <span x-show="darkMode">Switch to Light Mode ☀️</span>
                    </button>
                </div>
            @else
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">{{ __('Login') }}</x-nav-link>
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">{{ __('Register') }}</x-nav-link>
                    @endauth
        </div>
    </div>
</nav>
