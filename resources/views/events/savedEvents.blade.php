<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">الفعاليات المحفوظة</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-[#F7F8F0] dark:bg-[#393E46] overflow-hidden shadow-lg sm:rounded-2xl border border-[#9CD5FF] dark:border-[#948979]">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-[#948979] dark:text-[#948979]">
                        <thead
                            class="text-xs text-[#948979] uppercase bg-[#9CD5FF] dark:bg-[#222831] dark:text-[#948979]">
                            <tr>
                                <th scope="col" class="px-6 py-4">العنوان</th>
                                <th scope="col" class="px-6 py-4">تاريخ البدء</th>
                                <th scope="col" class="px-6 py-4">الكلية</th>
                                <th scope="col" class="px-6 py-4 text-right">رابط</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr
                                    class="bg-[#F7F8F0] border-b dark:bg-[#393E46] dark:border-[#948979] hover:bg-[#9CD5FF]/30 dark:hover:bg-[#948979]/50 transition-colors">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-[#355872] whitespace-nowrap dark:text-[#DFD0B8]">
                                        {{ $event->title }}
                                    </th>
                                    <td class="px-6 py-4 text-[#948979] dark:text-[#948979]">
                                        {{ $event->start_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-[#9CD5FF] text-[#355872] text-xs font-medium px-3 py-1 rounded-full dark:bg-[#948979] dark:text-[#DFD0B8]">
                                            {{ $event->faculty->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('eventShow', $event->id) }}"
                                            class="text-[#7AAACE] dark:text-[#7AAACE] hover:text-[#9CD5FF] dark:hover:text-[#9CD5FF] font-medium transition inline-flex items-center gap-1">
                                            عرض التفاصيل <span class="text-lg">←</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-10 text-center text-[#948979] dark:text-[#948979]">
                                        <div class="flex flex-col items-center">
                                            <span class="text-3xl mb-2">📅</span>
                                            <p>لا توجد فعاليات محفوظة</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (method_exists($events, 'links'))
                    <div class="mt-6 flex justify-center p-4">
                        {{ $events->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-main-layout>
