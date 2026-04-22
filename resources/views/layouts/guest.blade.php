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
    class="font-sans antialiased bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] transition-colors duration-300 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        {{ $slot }}
    </div>
</body>

</html>
