<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'منصة فعاليات جامعة الحواش') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body
    class="font-sans antialiased bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] transition-colors duration-300">
    @include('layouts.navigation')
    @isset($header)
        <header class="bg-[#F7F8F0] dark:bg-[#393E46] border-b border-[#9CD5FF] dark:border-[#948979] shadow-sm">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset
    <main class="min-h-screen">
        {{ $slot }}
    </main>
</body>

</html>
