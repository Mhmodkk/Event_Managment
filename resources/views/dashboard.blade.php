<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-blue-700 leading-tight">
            {{ __('HPU Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-slate-900 overflow-hidden shadow-lg sm:rounded-2xl border border-slate-200 dark:border-slate-700">
                <div class="p-8 md:p-10">

                    <!-- Welcome Section -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                        <div>
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-slate-100">
                                مرحباً، {{ auth()->user()->name }}!
                            </h3>
                            <p class="mt-2 text-lg text-slate-600 dark:text-slate-300">
                                كلية: <span class="font-semibold text-blue-700 dark:text-blue-400">
                                    {{ auth()->user()->faculty->name ?? 'غير محددة' }}
                                </span>
                            </p>
                        </div>

                        <div
                            class="px-5 py-3 rounded-full bg-blue-100 dark:bg-blue-950 text-blue-800 dark:text-blue-300 font-medium text-sm">
                            الحالة:
                            <span class="font-bold">
                                {{ auth()->user()->isSuperAdmin() ? 'مدير' : (auth()->user()->isAdmin() ? 'مشرف' : 'طالب') }}
                            </span>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                        <div
                            class="p-6 bg-blue-50 dark:bg-blue-950 rounded-xl border border-blue-100 dark:border-blue-900 shadow-sm">
                            <p class="text-sm text-blue-700 dark:text-blue-400 uppercase font-semibold tracking-wide">
                                حجوزاتي</p>
                            <p class="text-4xl font-black mt-2 text-blue-900 dark:text-blue-100">
                                {{ auth()->user()->attendings()->count() }}
                            </p>
                        </div>

                        @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                            <div
                                class="p-6 bg-purple-50 dark:bg-purple-950 rounded-xl border border-purple-100 dark:border-purple-900 shadow-sm">
                                <p
                                    class="text-sm text-purple-700 dark:text-purple-400 uppercase font-semibold tracking-wide">
                                    الفعاليات التي أنشأتها</p>
                                <p class="text-4xl font-black mt-2 text-purple-900 dark:text-purple-100">
                                    {{ auth()->user()->events()->count() }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Events Participation Tracking (للمشرفين فقط) -->
                    @if ((auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()) && $myEvents->count() > 0)
                        <div class="mb-12">
                            <h4 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-6 tracking-tight">تتبع
                                المشاركة في الفعاليات</h4>
                            <div class="overflow-x-auto border border-slate-200 dark:border-slate-700 rounded-xl">
                                <table class="w-full text-sm text-left">
                                    <thead
                                        class="bg-slate-50 dark:bg-slate-800 text-slate-700 dark:text-slate-300 uppercase text-xs">
                                        <tr>
                                            <th class="px-6 py-4">اسم الفعالية</th>
                                            <th class="px-6 py-4">حالة السعة</th>
                                            <th class="px-6 py-4">التاريخ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y dark:divide-slate-700">
                                        @foreach ($myEvents as $event)
                                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                                                <td class="px-6 py-4 font-semibold text-blue-700 dark:text-blue-400">
                                                    {{ $event->title }}</td>
                                                <td class="px-6 py-4">
                                                    <div class="flex justify-between text-sm mb-2 font-medium">
                                                        <span
                                                            class="text-slate-700 dark:text-slate-300">{{ $event->attendings_count }}
                                                            / {{ $event->num_tickets }}</span>
                                                        <span
                                                            class="text-blue-700 dark:text-blue-400">{{ round(($event->attendings_count / max($event->num_tickets, 1)) * 100) }}%</span>
                                                    </div>
                                                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-3">
                                                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-500 dark:to-indigo-500 h-3 rounded-full transition-all duration-500 shadow-md"
                                                            style="width: {{ round(($event->attendings_count / max($event->num_tickets, 1)) * 100) }}%">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                                    {{ $event->start_date->format('M d, Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <!-- Quick Actions -->
                    <hr class="my-8 border-slate-200 dark:border-slate-700">

                    @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                        <div>
                            <h4 class="text-xl font-semibold text-slate-800 dark:text-slate-200 mb-6">إجراءات سريعة</h4>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('events.create') }}"
                                    class="px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-lg font-medium transition shadow-md hover:shadow-lg">
                                    + إنشاء فعالية جديدة
                                </a>
                                <a href="{{ route('events.index') }}"
                                    class="px-6 py-3 bg-slate-200 dark:bg-slate-700 dark:text-blue-400 hover:bg-slate-400 dark:hover:bg-slate-500 rounded-lg font-medium transition">
                                    إدارة المحتوى الخاص بي
                                </a>
                                <a href="{{ route('attendingEvents') }}"
                                    class="px-6 py-3 border border-blue-500 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-950/30 rounded-lg font-medium transition">
                                    تذاكري المحجوزة
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
