    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8] leading-tight">
                لوحة التحكم
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-[#F7F8F0] dark:bg-[#393E46] overflow-hidden shadow-lg sm:rounded-2xl border border-[#9CD5FF] dark:border-[#948979]">
                    <div class="p-8 md:p-10">

                        <!-- Welcome Section -->
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                            <div>
                                <h3 class="text-3xl font-bold text-[#355872] dark:text-[#DFD0B8]">
                                    مرحباً، {{ auth()->user()->name }}!
                                </h3>
                                <p class="mt-2 text-lg text-[#948979] dark:text-[#948979]">
                                    كلية: <span class="font-semibold text-[#7AAACE] dark:text-[#7AAACE]">
                                        {{ auth()->user()->faculty->name ?? 'غير محددة' }}
                                    </span>
                                </p>
                            </div>

                            <div
                                class="px-5 py-3 rounded-full bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#222831] font-medium text-sm">
                                الحالة:
                                <span class="font-bold">
                                    {{ auth()->user()->isSuperAdmin() ? 'مدير' : (auth()->user()->isAdmin() ? 'مشرف' : 'طالب') }}
                                </span>
                            </div>
                        </div>

                        <!-- Stats Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                            <div
                                class="p-6 bg-[#9CD5FF] dark:bg-[#948979] rounded-xl border border-[#7AAACE] dark:border-[#DFD0B8] shadow-sm">
                                <p
                                    class="text-sm text-[#355872] dark:text-[#222831] uppercase font-semibold tracking-wide">
                                    حجوزاتي</p>
                                <p class="text-4xl font-black mt-2 text-[#355872] dark:text-[#DFD0B8]">
                                    {{ auth()->user()->attendings()->count() }}
                                </p>
                            </div>

                            @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                                <div
                                    class="p-6 bg-[#9CD5FF] dark:bg-[#948979] rounded-xl border border-[#7AAACE] dark:border-[#DFD0B8] shadow-sm">
                                    <p
                                        class="text-sm text-[#355872] dark:text-[#222831] uppercase font-semibold tracking-wide">
                                        الفعاليات التي أنشأتها</p>
                                    <p class="text-4xl font-black mt-2 text-[#355872] dark:text-[#DFD0B8]">
                                        {{ auth()->user()->events()->count() }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Events Participation Tracking -->
                        @if ((auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()) && $myEvents->count() > 0)
                            <div class="mb-12">
                                <h4 class="text-xl font-bold text-[#355872] dark:text-[#DFD0B8] mb-6 tracking-tight">
                                    تتبع المشاركة في الفعاليات</h4>
                                <div class="overflow-x-auto border border-[#9CD5FF] dark:border-[#948979] rounded-xl">
                                    <table class="w-full text-sm text-left">
                                        <thead
                                            class="bg-[#F7F8F0] dark:bg-[#393E46] text-[#948979] dark:text-[#948979] uppercase text-xs">
                                            <tr>
                                                <th class="px-6 py-4">اسم الفعالية</th>
                                                <th class="px-6 py-4">حالة السعة</th>
                                                <th class="px-6 py-4">التاريخ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y dark:divide-[#948979]">
                                            @foreach ($myEvents as $event)
                                                <tr class="hover:bg-[#F7F8F0] dark:hover:bg-[#393E46] transition">
                                                    <td
                                                        class="px-6 py-4 font-semibold text-[#355872] dark:text-[#DFD0B8]">
                                                        {{ $event->title }}</td>
                                                    <td class="px-6 py-4">
                                                        <div class="flex justify-between text-sm mb-2 font-medium">
                                                            <span
                                                                class="text-[#948979] dark:text-[#948979]">{{ $event->attendings_count }}
                                                                / {{ $event->num_tickets }}</span>
                                                            <span
                                                                class="text-[#7AAACE] dark:text-[#7AAACE]">{{ round(($event->attendings_count / max($event->num_tickets, 1)) * 100) }}%</span>
                                                        </div>
                                                        <div
                                                            class="w-full bg-[#9CD5FF] dark:bg-[#948979] rounded-full h-3">
                                                            <div class="bg-[#7AAACE] dark:bg-[#DFD0B8] h-3 rounded-full transition-all duration-500 shadow-md"
                                                                style="width: {{ round(($event->attendings_count / max($event->num_tickets, 1)) * 100) }}%">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-[#948979] dark:text-[#948979]">
                                                        {{ $event->start_date->format('M d, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <!-- Quick Actions -->
                        <hr class="my-8 border-[#9CD5FF] dark:border-[#948979]">

                        @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                            <div>
                                <h4 class="text-xl font-semibold text-[#355872] dark:text-[#DFD0B8] mb-6">إجراءات سريعة
                                </h4>
                                <div class="flex flex-wrap gap-4">
                                    <a href="{{ route('events.create') }}"
                                        class="px-6 py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-lg font-medium transition shadow-md hover:shadow-lg">+
                                        إنشاء فعالية جديدة</a>
                                    <a href="{{ route('events.index') }}"
                                        class="px-6 py-3 bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8] hover:bg-[#9CD5FF] dark:hover:bg-[#948979] rounded-lg font-medium transition">إدارة
                                        المحتوى الخاص بي</a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
