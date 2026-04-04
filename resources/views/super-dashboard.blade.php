<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8] leading-tight">
            لوحة تحكم المدير
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-[#F7F8F0] dark:bg-[#393E46] p-6 rounded-xl shadow">
                    <h3 class="text-lg font-medium text-[#948979] dark:text-[#948979]">إجمالي الفعاليات</h3>
                    <p class="text-3xl font-bold text-[#7AAACE] dark:text-[#7AAACE]">{{ $totalEvents }}</p>
                </div>

                <div class="bg-[#F7F8F0] dark:bg-[#393E46] p-6 rounded-xl shadow">
                    <h3 class="text-lg font-medium text-[#948979] dark:text-[#948979]">إجمالي الحجوزات</h3>
                    <p class="text-3xl font-bold text-[#7AAACE] dark:text-[#7AAACE]">{{ $totalBookings }}</p>
                </div>

                <div class="bg-[#F7F8F0] dark:bg-[#393E46] p-6 rounded-xl shadow">
                    <h3 class="text-lg font-medium text-[#948979] dark:text-[#948979]">نسبة الحضور</h3>
                    <p class="text-3xl font-bold text-[#7AAACE] dark:text-[#7AAACE]">{{ $attendanceRate }}%</p>
                </div>

                <div class="bg-[#F7F8F0] dark:bg-[#393E46] p-6 rounded-xl shadow">
                    <h3 class="text-lg font-medium text-[#948979] dark:text-[#948979]">الحضور الفعلي</h3>
                    <p class="text-3xl font-bold text-[#7AAACE] dark:text-[#7AAACE]">{{ $attendedCount }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-[#F7F8F0] dark:bg-[#393E46] rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-4 text-[#355872] dark:text-[#DFD0B8]">أكثر الكليات مشاركة</h3>
                    <ul class="space-y-3">
                        @forelse ($topFaculties as $faculty)
                            <li class="flex justify-between text-[#355872] dark:text-[#DFD0B8]">
                                <span>{{ $faculty['faculty'] }}</span>
                                <span class="font-bold">{{ $faculty['bookings'] }} حجز</span>
                            </li>
                        @empty
                            <li class="text-[#948979]">لا توجد بيانات</li>
                        @endforelse
                    </ul>
                </div>

                <div class="bg-[#F7F8F0] dark:bg-[#393E46] rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-4 text-[#355872] dark:text-[#DFD0B8]">آخر المستخدمين المسجلين</h3>
                    <ul class="space-y-3">
                        @forelse ($recentUsers as $user)
                            <li class="flex justify-between items-center text-[#355872] dark:text-[#DFD0B8]">
                                <span>{{ $user->name }} ({{ $user->role }})</span>
                                <span class="text-sm text-[#948979]">{{ $user->created_at->diffForHumans() }}</span>
                            </li>
                        @empty
                            <li class="text-[#948979]">لا مستخدمين جدد</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="mt-8 text-center flex flex-wrap justify-center gap-6">
                <a href="{{ route('users.index') }}"
                    class="inline-block px-8 py-4 bg-[#7AAACE] text-white rounded-xl font-bold hover:bg-[#9CD5FF] transition">
                    إدارة المستخدمين
                </a>

                <a href="{{ route('events.index') }}"
                    class="inline-block px-8 py-4 bg-[#7AAACE] text-white rounded-xl font-bold hover:bg-[#9CD5FF] transition">
                    إدارة الفعاليات
                </a>

                <a href="{{ route('galleries.index') }}"
                    class="inline-block px-8 py-4 bg-[#7AAACE] text-white rounded-xl font-bold hover:bg-[#9CD5FF] transition">
                    إدارة المعرض
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
