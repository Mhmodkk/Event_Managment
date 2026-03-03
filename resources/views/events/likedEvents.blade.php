<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-slate-900 dark:text-blue-700 leading-tight">
                {{ __('Liked Events') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-lg sm:rounded-2xl border border-slate-200 dark:border-slate-700">
                <div class="p-6 md:p-8">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50 dark:bg-slate-800 text-slate-700 dark:text-slate-300 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-4">اسم الفعالية</th>
                                    <th class="px-6 py-4">تاريخ البدء</th>
                                    <th class="px-6 py-4">الكلية</th>
                                    <th class="px-6 py-4 text-right">إجراء</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y dark:divide-slate-700">
                                @forelse($events as $event)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                                        <td class="px-6 py-4 font-medium text-blue-700 dark:text-blue-400">
                                            {{ $event->title }}
                                        </td>
                                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                            {{ $event->start_date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="bg-blue-100 dark:bg-blue-950 text-blue-800 dark:text-blue-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                {{ $event->faculty->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('eventShow', $event) }}"
                                               class="text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 font-medium transition">
                                                عرض
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                            <div class="flex flex-col items-center">
                                                <span class="text-5xl mb-4">❤️</span>
                                                <p class="text-lg">لا يوجد فعاليات مفضلة حالياً</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if (method_exists($events, 'links'))
                        <div class="mt-8 flex justify-center">
                            {{ $events->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
