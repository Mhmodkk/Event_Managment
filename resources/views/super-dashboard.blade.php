<x-main-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" dir="rtl">
        <!-- Quick Admin Links -->
        <div class="flex flex-wrap gap-3 mb-10">
            <a href="{{ route('events.index') }}"
                class="px-6 py-3 bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8] hover:bg-[#9CD5FF] dark:hover:bg-[#948979] rounded-xl font-medium transition border border-[#9CD5FF]">
                إدارة الفعاليات
            </a>
            <a href="{{ route('admin.users.index') }}"
                class="px-6 py-3 bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8] hover:bg-[#9CD5FF] dark:hover:bg-[#948979] rounded-xl font-medium transition border border-[#9CD5FF]">
                إدارة المستخدمين
            </a>
            <a href="{{ route('galleries.index') }}"
                class="px-6 py-3 bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8] hover:bg-[#9CD5FF] dark:hover:bg-[#948979] rounded-xl font-medium transition border border-[#9CD5FF]">
                إدارة المعرض
            </a>
            <!-- ✅ زر إدارة رموز الدعوة المضاف -->
            <a href="{{ route('admin.invitation-codes.index') }}"
                class="px-6 py-3 bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8] hover:bg-[#9CD5FF] dark:hover:bg-[#948979] rounded-xl font-medium transition border border-[#9CD5FF]">
                إدارة رموز الدعوة
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 text-right">
            <div class="bg-white dark:bg-[#393E46] p-6 rounded-xl shadow border-r-4 border-[#7AAACE]">
                <h3 class="text-[#948979] text-sm">إجمالي الفعاليات</h3>
                <p class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">{{ $totalEvents }}</p>
            </div>
            <div class="bg-white dark:bg-[#393E46] p-6 rounded-xl shadow border-r-4 border-[#9CD5FF]">
                <h3 class="text-[#948979] text-sm">إجمالي الحجوزات</h3>
                <p class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">{{ $totalBookings }}</p>
            </div>
            <div class="bg-white dark:bg-[#393E46] p-6 rounded-xl shadow border-r-4 border-[#7AAACE]">
                <h3 class="text-[#948979] text-sm">عدد الحاضرين</h3>
                <p class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">{{ $attendedCount }}</p>
            </div>
            <div class="bg-white dark:bg-[#393E46] p-6 rounded-xl shadow border-r-4 border-[#9CD5FF]">
                <h3 class="text-[#948979] text-sm">نسبة الحضور</h3>
                <p class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">{{ $attendanceRate }}%</p>
            </div>
        </div>

        <!-- Events Table -->
        <div class="bg-white dark:bg-[#393E46] rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 bg-[#355872] text-white flex justify-between items-center">
                <h3 class="font-bold">متابعة الفعاليات</h3>
                <a href="{{ route('events.index') }}" class="text-sm underline hover:text-[#9CD5FF]">عرض الكل →</a>
            </div>
            <table class="w-full text-right border-collapse">
                <thead class="bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8]">
                    <tr>
                        <th class="px-6 py-4">اسم الفعالية</th>
                        <th class="px-6 py-4">التاريخ</th>
                        <th class="px-6 py-4 text-center">السعة</th>
                        <th class="px-6 py-4 text-center">المسجلين</th>
                        <th class="px-6 py-4">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($allEvents as $event)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <td class="px-6 py-4 font-bold">{{ $event->title }}</td>
                            <td class="px-6 py-4 text-sm">{{ $event->start_date->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 text-center">{{ $event->num_tickets }}</td>
                            <td class="px-6 py-4 text-center font-bold text-[#7AAACE]">{{ $event->attendings_count }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('events.edit', $event->id) }}"
                                    class="text-blue-600 hover:underline">تعديل</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-[#948979]">لا توجد فعاليات حالياً</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-main-layout>
