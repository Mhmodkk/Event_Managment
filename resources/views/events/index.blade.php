<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Events Management - HPU') }}
            </h2>
            <div>
                @if (auth()->user()->isOrganizer())
                    <a href="{{ route('events.create') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                        + New Event
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Event Title</th>
                            <th scope="col" class="px-6 py-3">Faculty</th>
                            <th scope="col" class="px-6 py-3">Start Date</th>
                            <th scope="col" class="px-6 py-3">Tickets</th>
                            <th scope="col" class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $event->title }}
                                </th>
                                <td class="px-6 py-4">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                        {{ $event->faculty->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->start_date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->num_tickets }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('events.edit', $event) }}"
                                            class="font-medium text-green-600 dark:text-green-400 hover:underline">Edit</a>

                                        <form method="POST" action="{{ route('events.destroy', $event) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this event?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-400 hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center">
                                        <span class="text-3xl mb-2">📅</span>
                                        <p>No events found for Al-Hawash University.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
