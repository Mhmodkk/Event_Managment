<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-900 dark:text-blue-700 leading-tight">
                {{ __('Saved Events') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-lg sm:rounded-2xl border border-slate-200 dark:border-slate-700">
                <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-800 dark:text-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Start Date</th>
                            <th scope="col" class="px-6 py-3">Faculty</th>
                            <th scope="col" class="px-6 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr class="bg-white border-b dark:bg-slate-900 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap dark:text-slate-100">
                                    {{ $event->title }}
                                </th>
                                <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                                    {{ $event->start_date->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900/50 dark:text-blue-300">
                                        {{ $event->faculty->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('eventShow', $event) }}"
                                       class="text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 font-medium transition">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400">
                                    <div class="flex flex-col items-center">
                                        <span class="text-3xl mb-2">📅</span>
                                        <p>No saved events found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($events, 'links'))
                <div class="mt-6 flex justify-center">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
