<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard - HPU University') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Welcome Section --}}
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}!</h3>
                        <p class="text-gray-600 dark:text-gray-400">You have successfully logged into the HPU Events Management Platform.</p>
                    </div>

                    <hr class="my-4 border-gray-200 dark:border-gray-700">

                    {{-- Role-Based Logic --}}
                    @if(auth()->user()->isOrganizer())
                        {{-- Organizer View --}}
                        <div class="bg-indigo-50 dark:bg-indigo-900/30 p-6 rounded-xl border border-indigo-100 dark:border-indigo-800">
                            <h4 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300 mb-2">Organizer Privileges</h4>
                            <p class="mb-4">You can now create new activities for HPU students or manage your existing events.</p>

                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    + Add New Event
                                </a>
                                <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 transition ease-in-out duration-150">
                                    Manage My Events
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- Student View --}}
                        <div class="bg-green-50 dark:bg-green-900/30 p-6 rounded-xl border border-green-100 dark:border-green-800">
                            <h4 class="text-lg font-semibold text-green-700 dark:text-green-300 mb-2">Student Account</h4>
                            <p class="mb-4">Explore scientific, athletic, and cultural activities across HPU faculties.</p>

                            <a href="/" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">
                                ← Browse Available Events Now
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
