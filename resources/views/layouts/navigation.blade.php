<nav x-data="{ open: false }" class="bg-[var(--color-bg-card)] border-b border-[var(--color-border)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('storage/logos/hpu-logo.png') }}" alt="HPU Logo"
                            class="h-9 w-auto object-contain">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if (auth()->user()->isOrganizer())
                        <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')"
                            class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                            {{ __('My Events') }}
                        </x-nav-link>
                    @endif
                    <x-nav-link :href="route('eventIndex')" :active="request()->routeIs('eventIndex') || request()->is('/') || request()->is('e')"
                        class="text-blue-700 hover:text-blue-900 dark:text-blue-300 dark:hover:text-blue-100">
                        {{ __('Explore Events') }}
                    </x-nav-link>
                    <x-nav-link :href="route('galleries.index')" :active="request()->routeIs('galleries.*')"
                        class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                        {{ __('Gallery') }}
                    </x-nav-link>
                    <x-nav-link :href="route('likedEvents')" :active="request()->routeIs('likedEvents')"
                        class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                        {{ __('Liked') }}
                    </x-nav-link>
                    <x-nav-link :href="route('savedEvents')" :active="request()->routeIs('savedEvents')"
                        class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                        {{ __('Saved') }}
                    </x-nav-link>
                    <x-nav-link :href="route('attendingEvents')" :active="request()->routeIs('attendingEvents')"
                        class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                        {{ __('Attending') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- زر تبديل الثيم -->
                <button @click="darkMode = !darkMode"
                    class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 transition duration-200">
                    <span x-show="!darkMode" class="text-xl">🌙</span>
                    <span x-show="darkMode" class="text-xl">☀️</span>
                </button>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[var(--color-text-secondary)] bg-[var(--color-bg-card)] hover:text-[var(--color-text-primary)] focus:outline-none transition ease-in-out duration-150">
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
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-700 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-700 dark:focus:bg-gray-700 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
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

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if (auth()->user()->isOrganizer())
                <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')"
                    class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                    {{ __('My Events') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('galleries.index')" :active="request()->routeIs('galleries.*')"
                class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                {{ __('Gallery') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('likedEvents')" :active="request()->routeIs('likedEvents')"
                class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                {{ __('Liked') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('savedEvents')" :active="request()->routeIs('savedEvents')"
                class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                {{ __('Saved') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('attendingEvents')" :active="request()->routeIs('attendingEvents')"
                class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                {{ __('Attending') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- زر تبديل الثيم في الموبايل -->
                <div class="px-4 py-2">
                    <button @click="darkMode = !darkMode"
                        class="w-full text-left px-3 py-2 rounded-md bg-gray-700 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                        <span x-show="!darkMode">Switch to Dark Mode 🌙</span>
                        <span x-show="darkMode">Switch to Light Mode ☀️</span>
                    </button>
                </div>

                <x-responsive-nav-link :href="route('profile.edit')"
                    class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-blue-700 hover:text-blue-700 dark:text-blue-700 dark:hover:text-blue-700">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
