<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
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

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                @auth
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">{{ __('Login') }}</x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">{{ __('Register') }}</x-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>
