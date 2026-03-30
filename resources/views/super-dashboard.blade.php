<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            لوحة تحكم  المدير
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">إجمالي الفعاليات</h3>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalEvents }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">إجمالي الحجوزات</h3>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $totalBookings }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">نسبة الحضور</h3>
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $attendanceRate }}%</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">الحضور الفعلي</h3>
                    <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $attendedCount }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-4">أكثر الكليات مشاركة</h3>
                    <ul class="space-y-3">
                        @forelse ($topFaculties as $faculty)
                            <li class="flex justify-between">
                                <span>{{ $faculty['faculty'] }}</span>
                                <span class="font-bold">{{ $faculty['bookings'] }} حجز</span>
                            </li>
                        @empty
                            <li>لا توجد بيانات</li>
                        @endforelse
                    </ul>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-4">آخر المستخدمين المسجلين</h3>
                    <ul class="space-y-3">
                        @forelse ($recentUsers as $user)
                            <li class="flex justify-between items-center">
                                <span>{{ $user->name }} ({{ $user->role }})</span>
                                <span class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                            </li>
                        @empty
                            <li>لا مستخدمين جدد</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="mt-8 text-center flex flex-wrap justify-center gap-6">
                <a href="{{ route('users.index') }}"
                    class="inline-block px-8 py-4 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition">
                    إدارة المستخدمين
                </a>

                <a href="{{ route('events.index') }}"
                    class="inline-block px-8 py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition">
                    إدارة الفعاليات
                </a>

                <a href="{{ route('galleries.index') }}"
                    class="inline-block px-8 py-4 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700 transition">
                    إدارة المعرض
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
