<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HPU Events') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div x-data="{ darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) }" x-init="$watch('darkMode', value => {
        if (value) {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        }
    });
    if (darkMode) document.documentElement.classList.add('dark');" x-bind:class="{ 'dark': darkMode }">

        <div
            class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F7F8F0] dark:bg-[#222831]">
            <div class="mb-8">
                <a href="/">
                    <img src="{{ asset('logos/HPU.png') }}" alt="HPU Logo" class="w-24 h-auto object-contain">
                </a>
            </div>

            <div
                class="w-full sm:max-w-md px-6 py-8 bg-[#F7F8F0] dark:bg-[#393E46] shadow-xl rounded-xl border border-[#9CD5FF] dark:border-[#948979]">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
