<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#355872] dark:text-[#DFD0B8] leading-tight">
                إدارة الحضور - {{ $event->title }}
            </h2>
            <div class="text-sm text-[#948979] dark:text-[#948979]">
                التذاكر المتبقية: <strong>{{ $remainingTickets }}</strong> / {{ $event->num_tickets }}
            </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- إحصائيات سريعة -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div
                    class="bg-[#F7F8F0] dark:bg-[#393E46] p-6 rounded-xl shadow border border-[#9CD5FF] dark:border-[#948979] text-center">
                    <p class="text-sm text-[#948979] dark:text-[#948979]">إجمالي الحجوزات</p>
                    <p class="text-3xl font-bold text-[#7AAACE] dark:text-[#7AAACE]">{{ $totalBooked }}</p>
                </div>
                <div
                    class="bg-[#F7F8F0] dark:bg-[#393E46] p-6 rounded-xl shadow border border-[#9CD5FF] dark:border-[#948979] text-center">
                    <p class="text-sm text-[#948979] dark:text-[#948979]">الحاضرون فعلياً</p>
                    <p class="text-3xl font-bold text-[#7AAACE] dark:text-[#7AAACE]">{{ $totalAttended }}</p>
                </div>
                <div
                    class="bg-[#F7F8F0] dark:bg-[#393E46] p-6 rounded-xl shadow border border-[#9CD5FF] dark:border-[#948979] text-center">
                    <p class="text-sm text-[#948979] dark:text-[#948979]">نسبة الحضور</p>
                    <p class="text-3xl font-bold text-[#7AAACE] dark:text-[#7AAACE]">
                        {{ $totalBooked > 0 ? round(($totalAttended / $totalBooked) * 100) : 0 }}%
                    </p>
                </div>
            </div>

            <!-- جدول الحضور -->
            <div
                class="bg-[#F7F8F0] dark:bg-[#393E46] shadow overflow-hidden sm:rounded-lg border border-[#9CD5FF] dark:border-[#948979]">
                <table class="min-w-full divide-y divide-[#9CD5FF] dark:divide-[#948979]">
                    <thead class="bg-[#9CD5FF] dark:bg-[#222831]">
                        <tr>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                الاسم</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                النوع</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                عدد التذاكر</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                حالة الحضور</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                مسح بواسطة</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-[#948979] dark:text-[#948979] uppercase tracking-wider">
                                تاريخ التأكيد</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#F7F8F0] dark:bg-[#393E46] divide-y divide-[#9CD5FF] dark:divide-[#948979]">
                        @forelse ($attendings as $attending)
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-[#355872] dark:text-[#DFD0B8]">
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
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#7AAACE]/20 text-[#355872] border border-[#7AAACE]/30">
                                            حاضر
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                            لم يحضر بعد
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
                                <td colspan="6" class="px-6 py-10 text-center text-[#948979] dark:text-[#948979]">
                                    لا يوجد حجوزات حتى الآن
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
