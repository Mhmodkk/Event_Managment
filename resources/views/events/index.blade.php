<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">إدارة الفعاليات</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <div class="mb-6 flex justify-end">
                    <a href="{{ route('events.create') }}"
                        class="px-6 py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-xl font-medium transition-all shadow-md hover:shadow-lg transform hover:scale-[1.02]">
                        + إنشاء فعالية جديدة
                    </a>
                </div>
            @endif

            <div class="relative overflow-x-auto shadow-lg sm:rounded-2xl border border-[#9CD5FF] dark:border-[#948979]">
                <table class="w-full text-sm text-left text-[#948979] dark:text-[#948979]">
                    <thead class="text-xs text-[#948979] uppercase bg-[#9CD5FF] dark:bg-[#222831] dark:text-[#948979]">
                        <tr>
                            <th scope="col" class="px-6 py-4">اسم الفعالية</th>
                            <th scope="col" class="px-6 py-4">الكلية</th>
                            <th scope="col" class="px-6 py-4">تاريخ البدء</th>
                            <th scope="col" class="px-6 py-4">عدد التذاكر</th>
                            <th scope="col" class="px-6 py-4 text-right">الإجراءات</th>
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
                                <td class="px-6 py-4">
                                    <span
                                        class="bg-[#9CD5FF] text-[#355872] text-xs font-medium px-3 py-1 rounded-full dark:bg-[#948979] dark:text-[#DFD0B8]">
                                        {{ $event->faculty->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-[#948979] dark:text-[#948979]">
                                    {{ $event->start_date->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-[#948979] dark:text-[#948979]">
                                    {{ $event->num_tickets }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-4 rtl:space-x-reverse">
                                    <a href="{{ route('events.edit', $event->id) }}"
                                        class="text-[#7AAACE] dark:text-[#7AAACE] hover:text-[#9CD5FF] dark:hover:text-[#9CD5FF] font-medium transition">
                                        تعديل
                                    </a>
                                    <form method="POST" action="{{ route('events.destroy', $event->id) }}"
                                        class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الفعالية؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium transition">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-[#948979] dark:text-[#948979]">
                                    <div class="flex flex-col items-center">
                                        <span class="text-5xl mb-4">📅</span>
                                        <p class="text-lg">لا توجد فعاليات مسجلة حالياً</p>
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
</x-main-layout>
