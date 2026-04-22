<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">الفعاليات التي أشارك فيها</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-[#F7F8F0] dark:bg-[#393E46] overflow-hidden shadow-xl rounded-2xl border border-[#9CD5FF] dark:border-[#948979]">
                <div class="p-6 md:p-8">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead
                                class="bg-[#9CD5FF] dark:bg-[#222831] text-[#948979] dark:text-[#948979] uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-4">اسم الفعالية</th>
                                    <th class="px-6 py-4">تاريخ البدء</th>
                                    <th class="px-6 py-4">الكلية</th>
                                    <th class="px-6 py-4 text-right">إجراء</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y dark:divide-[#948979]">
                                @forelse($events as $event)
                                    <tr class="hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/30 transition-colors">
                                        <td class="px-6 py-4 font-bold text-[#7AAACE] dark:text-[#7AAACE]">
                                            {{ $event->title }}
                                        </td>
                                        <td class="px-6 py-4 text-[#948979] dark:text-[#948979]">
                                            {{ $event->start_date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                                {{ $event->faculty->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('eventShow', $event->id) }}"
                                                class="text-[#7AAACE] dark:text-[#7AAACE] hover:text-[#355872] dark:hover:text-[#DFD0B8] font-semibold transition inline-flex items-center gap-1 group">
                                                عرض التفاصيل <span
                                                    class="text-lg transition-transform group-hover:translate-x-1">←</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-6 py-14 text-center text-[#948979] dark:text-[#948979]">
                                            <div class="flex flex-col items-center">
                                                <span class="text-5xl mb-4">🎟️</span>
                                                <p class="text-lg font-medium">لا توجد فعاليات أنت مشارك فيها حالياً</p>
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
</x-main-layout>
