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

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                        <div>
                            <h3 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}!</h3>
                            <p class="text-indigo-500 font-medium">Faculty:
                                {{ auth()->user()->faculty->name ?? 'Not Assigned' }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-lg text-sm">
                            Status: <span
                                class="font-bold text-green-500">{{ auth()->user()->isOrganizer() ? 'Organizer' : 'Student' }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div
                            class="p-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 rounded-xl">
                            <p class="text-sm text-blue-600 dark:text-blue-400 uppercase font-bold">My Bookings</p>
                            <p class="text-3xl font-black mt-1">{{ auth()->user()->attendings()->count() }}</p>
                        </div>

                        @if (auth()->user()->isOrganizer())
                            <div
                                class="p-6 bg-purple-50 dark:bg-purple-900/20 border border-purple-100 dark:border-purple-800 rounded-xl">
                                <p class="text-sm text-purple-600 dark:text-purple-400 uppercase font-bold">My Created
                                    Events</p>
                                <p class="text-3xl font-black mt-1">{{ auth()->user()->events()->count() }}</p>
                            </div>
                        @endif
                    </div>

                    @if (auth()->user()->isOrganizer() && $myEvents->count() > 0)
                        <div class="mt-10 mb-8">
                            <h4 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4 tracking-tight">Events
                                Participation Tracking</h4>
                            <div class="overflow-x-auto border dark:border-gray-700 rounded-lg">
                                <table class="w-full text-sm text-left">
                                    <thead
                                        class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-400 uppercase text-xs">
                                        <tr>
                                            <th class="px-6 py-3">Event Name</th>
                                            <th class="px-6 py-3">Capacity Status</th>
                                            <th class="px-6 py-3">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y dark:divide-gray-700">
                                        @foreach ($myEvents as $event)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition">
                                                <td
                                                    class="px-6 py-4 font-semibold text-indigo-600 dark:text-indigo-400">
                                                    {{ $event->title }}</td>
                                                <td class="px-6 py-4">
                                                    <div class="flex justify-between mb-1">
                                                        <span>{{ $event->attendings_count }} /
                                                            {{ $event->num_tickets }}</span>
                                                        <span>{{ round(($event->attendings_count / max($event->num_tickets, 1)) * 100) }}%</span>
                                                    </div>
                                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                                        <div class="bg-indigo-600 h-1.5 rounded-full"
                                                            style="width: {{ ($event->attendings_count / max($event->num_tickets, 1)) * 100 }}%">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-xs text-gray-500">{{ $event->start_date }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <div>
                        <h4 class="text-lg font-semibold mb-4">Quick Actions</h4>
                        <div class="flex flex-wrap gap-4">
                            @if (auth()->user()->isOrganizer())
                                <a href="{{ route('events.create') }}"
                                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold transition shadow-lg shadow-indigo-500/30">
                                    + Create New Activity
                                </a>
                            @endif
                            <a href="{{ route('events.index') }}"
                                class="px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-bold transition">
                                Manage My Content
                            </a>
                            <a href="{{ route('attendingEvents') }}"
                                class="px-6 py-3 border border-indigo-500 text-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg font-bold transition">
                                My Reserved Tickets
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
