<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8] leading-tight">
                أرشيف المعرض
            </h2>
            <div>
                @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                    <a href="{{ route('galleries.create') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-xl font-medium transition-all shadow-md hover:shadow-lg transform hover:scale-[1.02] border border-transparent hover:border-[#9CD5FF]">
                        <span class="text-xl">+</span> إضافة صورة جديدة
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-[#F7F8F0] dark:bg-[#393E46] overflow-hidden shadow-xl sm:rounded-2xl border border-[#9CD5FF] dark:border-[#948979]">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-[#948979] dark:text-[#948979]">
                        <thead
                            class="text-xs text-[#948979] uppercase bg-[#9CD5FF] dark:bg-[#222831] dark:text-[#948979]">
                            <tr>
                                <th scope="col" class="px-9 py-4 text-right">الصورة</th>
                                <th scope="col" class="px-6 py-4">الفعالية</th>
                                <th scope="col" class="px-6 py-4">الشرح</th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    {{ auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() ? 'الإجراءات' : 'معلومات' }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#9CD5FF] dark:divide-[#948979]">
                            @forelse($galleries as $gallery)
                                <tr
                                    class="bg-[#F7F8F0] dark:bg-[#393E46] hover:bg-[#9CD5FF]/20 dark:hover:bg-[#948979]/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/' . $gallery->image) }}"
                                            alt="{{ $gallery->caption }}"
                                            class="w-20 h-20 object-cover rounded-xl shadow-sm border-2 border-[#9CD5FF] dark:border-[#948979] hover:scale-105 transition-transform duration-300">
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-[#7AAACE] dark:text-[#7AAACE]">
                                        {{ $gallery->event->title ?? 'فعالية غير محددة' }}
                                    </td>

                                    <td class="px-6 py-4 font-medium text-[#355872] dark:text-[#DFD0B8]">
                                        {{ Str::limit($gallery->caption, 60) }}
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                                            <div class="flex items-center justify-end gap-4">
                                                <a href="{{ route('galleries.edit', $gallery) }}"
                                                    class="font-medium text-[#7AAACE] dark:text-[#7AAACE] hover:text-[#355872] dark:hover:text-[#DFD0B8] transition inline-flex items-center gap-1">
                                                    تعديل
                                                </a>

                                                <form method="POST" action="{{ route('galleries.destroy', $gallery) }}"
                                                    onsubmit="return confirm('هل أنت متأكد من حذف هذه الصورة؟');"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="font-medium text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition">
                                                        حذف
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="flex flex-col items-end gap-1">
                                                <span
                                                    class="text-xs text-[#7AAACE] dark:text-[#7AAACE] font-bold uppercase tracking-wider bg-[#9CD5FF]/30 dark:bg-[#948979]/30 px-2 py-1 rounded-md">
                                                    صورة معرض
                                                </span>
                                                <span class="text-[#948979] dark:text-[#948979] text-xs">
                                                    نشرت: {{ $gallery->created_at->format('M d, Y') }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-14 text-center text-[#948979] dark:text-[#948979]">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 mb-4 text-[#948979] dark:text-[#948979] opacity-50"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="text-lg font-medium">لا توجد صور في الأرشيف حتى الآن</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if (method_exists($galleries, 'links'))
                <div class="mt-8 flex justify-center">
                    {{ $galleries->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
