<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">
            لوحة التحكم
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div
                class="bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl shadow-xl border border-[#9CD5FF] dark:border-[#948979] overflow-hidden">

                <!-- Welcome Header -->
                <div class="p-8 md:p-10 border-b border-[#9CD5FF] dark:border-[#948979]">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div>
                            <h3 class="text-4xl font-bold text-[#355872] dark:text-[#DFD0B8]">
                                مرحباً، {{ auth()->user()->name }} 👋
                            </h3>
                            <p class="mt-3 text-lg text-[#948979]">
                                كلية:
                                <span class="font-semibold text-[#7AAACE] dark:text-[#DFD0B8]">
                                    {{ auth()->user()->faculty->name ?? 'غير محددة' }}
                                </span>
                            </p>
                        </div>

                        <div
                            class="px-6 py-3 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#222831] rounded-2xl font-medium text-sm flex items-center gap-2">
                            <span>الحالة:</span>
                            <span class="font-bold">
                                {{ auth()->user()->isSuperAdmin() ? 'مدير المنصة' : (auth()->user()->isAdmin() ? 'مشرف كلية' : 'طالب') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-8 md:p-10">

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-14">

                        <!-- للطلاب -->
                        @if (!auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin())
                            <div
                                class="p-8 bg-white dark:bg-[#222831] rounded-2xl border border-[#9CD5FF] dark:border-[#948979] shadow-sm">
                                <p class="uppercase text-xs tracking-widest text-[#948979]">حجوزاتي</p>
                                <p class="text-5xl font-black mt-4 text-[#355872] dark:text-[#DFD0B8]">
                                    {{ auth()->user()->attendings()->count() }}
                                </p>
                            </div>
                        @endif

                        <!-- للإداريين -->
                        @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                            <div
                                class="p-8 bg-white dark:bg-[#222831] rounded-2xl border border-[#9CD5FF] dark:border-[#948979] shadow-sm">
                                <p class="uppercase text-xs tracking-widest text-[#948979]">الفعاليات التي أنشأتها</p>
                                <p class="text-5xl font-black mt-4 text-[#355872] dark:text-[#DFD0B8]">
                                    {{ auth()->user()->events()->count() }}
                                </p>
                            </div>
                        @endif

                    </div>

                    <!-- تتبع المشاركة (للإداريين فقط) -->
                    @if ((auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()) && $myEvents->count() > 0)
                        <div class="mb-14">
                            <h4 class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8] mb-6">
                                تتبع المشاركة في الفعاليات
                            </h4>

                            <div class="overflow-x-auto rounded-2xl border border-[#9CD5FF] dark:border-[#948979]">
                                <table class="w-full text-sm">
                                    <thead class="bg-[#F7F8F0] dark:bg-[#222831] text-[#948979] uppercase text-xs">
                                        <tr>
                                            <th class="px-6 py-5 text-right">اسم الفعالية</th>
                                            <th class="px-6 py-5 text-right">حالة السعة</th>
                                            <th class="px-6 py-5 text-right">التاريخ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y dark:divide-[#948979]">
                                        @foreach ($myEvents as $event)
                                            <tr class="hover:bg-[#F7F8F0] dark:hover:bg-[#393E46] transition-colors">
                                                <td class="px-6 py-5 font-medium text-[#355872] dark:text-[#DFD0B8]">
                                                    {{ $event->title }}
                                                </td>
                                                <td class="px-6 py-5">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <span class="text-[#948979]">
                                                            {{ $event->attendings_count }} / {{ $event->num_tickets }}
                                                        </span>
                                                        <span class="font-medium text-[#7AAACE]">
                                                            {{ round(($event->attendings_count / max($event->num_tickets, 1)) * 100) }}%
                                                        </span>
                                                    </div>
                                                    <div
                                                        class="h-2.5 bg-[#9CD5FF] dark:bg-[#948979] rounded-full overflow-hidden">
                                                        <div class="h-full bg-[#7AAACE] dark:bg-[#DFD0B8] rounded-full transition-all duration-700"
                                                            style="width: {{ round(($event->attendings_count / max($event->num_tickets, 1)) * 100) }}%">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-5 text-sm text-[#948979]">
                                                    {{ $event->start_date->format('d M, Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <!-- Quick Actions -->
                    @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                        <div>
                            <h4 class="text-xl font-semibold text-[#355872] dark:text-[#DFD0B8] mb-6">إجراءات سريعة</h4>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('events.create') }}"
                                    class="flex items-center gap-2 px-7 py-4 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-2xl font-medium transition-all shadow-md hover:shadow-xl">
                                    <span class="text-xl">+</span>
                                    إنشاء فعالية جديدة
                                </a>

                                <a href="{{ route('events.index') }}"
                                    class="px-7 py-4 bg-white dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] border border-[#9CD5FF] dark:border-[#948979] hover:border-[#7AAACE] rounded-2xl font-medium transition-all">
                                    إدارة فعالياتي
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
