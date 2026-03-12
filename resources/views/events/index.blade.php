<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-slate-900 dark:text-blue-700 leading-tight">
                {{ __('Events Management - HPU') }}
            </h2>

            @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <a href="{{ route('events.create') }}"
                   class="px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-lg font-medium transition shadow-md hover:shadow-lg">
                    + فعالية جديدة
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-slate-200 dark:border-slate-700">
                <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-800 dark:text-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-3">اسم الفعالية</th>
                            <th scope="col" class="px-6 py-3">الكلية</th>
                            <th scope="col" class="px-6 py-3">تاريخ البدء</th>
                            <th scope="col" class="px-6 py-3">عدد التذاكر</th>
                            <th scope="col" class="px-6 py-3 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr class="bg-white border-b dark:bg-slate-900 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap dark:text-slate-100">
                                    {{ $event->title }}
                                </th>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900/50 dark:text-blue-300">
                                        {{ $event->faculty->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                                    {{ $event->start_date->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                                    {{ $event->num_tickets }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-4">
                                    <a href="{{ route('events.edit', $event) }}"
                                       class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-medium transition">
                                        تعديل
                                    </a>
                                    <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline"
                                          onsubmit="return confirm('هل أنت متأكد من حذف الفعالية؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium transition">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                    <div class="flex flex-col items-center">
                                        <span class="text-5xl mb-4">📅</span>
                                        <p class="text-lg">لا يوجد فعاليات مسجلة في جامعة الحواش حالياً</p>
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
</x-app-layout>
