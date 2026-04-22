<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">
            إدارة الحضور - {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- إحصائيات سريعة -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div
                    class="bg-[#F7F8F0] dark:bg-[#393E46] p-6 rounded-2xl shadow-lg border border-[#9CD5FF] dark:border-[#948979] text-center transition-all hover:shadow-xl">
                    <p class="text-sm text-[#948979] dark:text-[#948979] mb-2">إجمالي الحجوزات</p>
                    <p class="text-3xl font-black text-[#7AAACE] dark:text-[#7AAACE]">{{ $totalBooked }}</p>
                </div>
                <div
                    class="bg-[#F7F8F0] dark:bg-[#393E46] p-6 rounded-2xl shadow-lg border border-[#9CD5FF] dark:border-[#948979] text-center transition-all hover:shadow-xl">
                    <p class="text-sm text-[#948979] dark:text-[#948979] mb-2">الحاضرون فعلياً</p>
                    <p class="text-3xl font-black text-[#7AAACE] dark:text-[#7AAACE]">{{ $totalAttended }}</p>
                </div>
                <div
                    class="bg-[#F7F8F0] dark:bg-[#393E46] p-6 rounded-2xl shadow-lg border border-[#9CD5FF] dark:border-[#948979] text-center transition-all hover:shadow-xl">
                    <p class="text-sm text-[#948979] dark:text-[#948979] mb-2">نسبة الحضور</p>
                    <p class="text-3xl font-black text-[#7AAACE] dark:text-[#7AAACE]">
                        {{ $totalBooked > 0 ? round(($totalAttended / $totalBooked) * 100) : 0 }}%
                    </p>
                </div>
            </div>

            <!-- جدول الحضور -->
            <div
                class="bg-[#F7F8F0] dark:bg-[#393E46] shadow-xl overflow-hidden rounded-2xl border border-[#9CD5FF] dark:border-[#948979]">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#9CD5FF] dark:divide-[#948979]">
                        <thead class="bg-[#9CD5FF] dark:bg-[#222831]">
                            <tr>
                                <th
                                    class="px-6 py-4 text-right text-xs font-bold text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                    الاسم</th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-bold text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                    النوع</th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-bold text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                    عدد التذاكر</th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-bold text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                    حالة الحضور</th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-bold text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                    مسح بواسطة</th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-bold text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                    تاريخ التأكيد</th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#F7F8F0] dark:bg-[#393E46] divide-y divide-[#9CD5FF] dark:divide-[#948979]">
                            @forelse ($attendings as $attending)
                                <tr class="hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/30 transition-colors">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-[#355872] dark:text-[#DFD0B8]">
                                        {{ $attending->attendee_name }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm text-[#948979] dark:text-[#948979]">
                                        {{ $attending->attendee_type }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm text-[#948979] dark:text-[#948979]">
                                        {{ $attending->num_tickets }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        @if ($attending->hasAttended())
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-[#7AAACE]/20 text-[#355872] dark:text-[#DFD0B8] border border-[#7AAACE]/40">
                                                حاضر ✓
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-800">
                                                لم يحضر
                                            </span>
                                        @endif
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm text-[#948979] dark:text-[#948979]">
                                        {{ $attending->scanner?->name ?? '-' }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm text-[#948979] dark:text-[#948979]">
                                        {{ $attending->attended_at ? $attending->attended_at->format('Y-m-d H:i') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-12 text-center text-[#948979] dark:text-[#948979]">
                                        <div class="flex flex-col items-center">
                                            <span class="text-4xl mb-3">🎫</span>
                                            <p class="text-lg font-medium">لا يوجد حجوزات حتى الآن</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
