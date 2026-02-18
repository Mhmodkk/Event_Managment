<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('HPU Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- معلومات المستخدم والكلية --}}
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                        <div>
                            <h3 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}!</h3>
                            <p class="text-indigo-500 font-medium">Faculty: {{ auth()->user()->faculty->name ?? 'Not Assigned' }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-lg text-sm">
                            Status: <span class="font-bold text-green-500">{{ auth()->user()->isOrganizer() ? 'Organizer' : 'Student' }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        {{-- إحصائية 1 --}}
                        <div class="p-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 rounded-xl">
                            <p class="text-sm text-blue-600 dark:text-blue-400 uppercase font-bold">My Bookings</p>
                            <p class="text-3xl font-black mt-1">{{ auth()->user()->attendings()->count() }}</p>
                        </div>

                        {{-- إحصائية 2 للمنظم فقط --}}
                        @if(auth()->user()->isOrganizer())
                        <div class="p-6 bg-purple-50 dark:bg-purple-900/20 border border-purple-100 dark:border-purple-800 rounded-xl">
                            <p class="text-sm text-purple-600 dark:text-purple-400 uppercase font-bold">My Events</p>
                            <p class="text-3xl font-black mt-1">{{ auth()->user()->events()->count() }}</p>
                        </div>
                        @endif
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    {{-- الإجراءات السريعة --}}
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Quick Actions</h4>
                        <div class="flex flex-wrap gap-4">
                            @if(auth()->user()->isOrganizer())
                                <a href="{{ route('events.create') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold transition">
                                    + Create New Activity
                                </a>
                            @endif
                            <a href="{{ route('events.index') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-bold transition">
                                Browse All Events
                            </a>
                            <a href="{{ route('attendingEvents') }}" class="px-6 py-3 border border-indigo-500 text-indigo-500 hover:bg-indigo-50 rounded-lg font-bold transition">
                                My Reserved Tickets
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
