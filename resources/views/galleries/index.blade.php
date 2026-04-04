<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8] leading-tight">
                {{ __('أرشيف المعرض') }}
            </h2>
            <div>
                @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                    <a href="{{ route('galleries.create') }}"
                        class="text-white bg-[#7AAACE] hover:bg-[#9CD5FF] focus:ring-4 focus:ring-[#7AAACE]/50 font-medium rounded-lg text-sm px-6 py-3 transition duration-200 ease-in-out transform hover:scale-105 border border-[#7AAACE]">
                        + معرض جديد
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-[#F7F8F0] dark:bg-[#393E46] overflow-hidden shadow-lg sm:rounded-2xl border border-[#9CD5FF] dark:border-[#948979]">
                <table class="w-full text-sm text-left text-[#948979] dark:text-[#948979]">
                    <thead class="text-xs text-[#948979] uppercase bg-[#9CD5FF] dark:bg-[#222831] dark:text-[#948979]">
                        <tr>
                            <th scope="col" class="px-6 py-3">صورة</th>
                            <th scope="col" class="px-6 py-3">الفعالية</th>
                            <th scope="col" class="px-6 py-3">شرح</th>
                            <th scope="col" class="px-6 py-3">
                                {{ auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() ? 'رابط' : 'معلومات' }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $gallery)
                            <tr
                                class="bg-[#F7F8F0] border-b dark:bg-[#393E46] dark:border-[#948979] hover:bg-[#9CD5FF] dark:hover:bg-[#948979] transition-colors">
                                <td class="px-6 py-4">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->caption }}"
                                        class="w-20 h-20 object-cover rounded-lg shadow-sm border border-[#9CD5FF] dark:border-[#948979]">
                                </td>

                                <td class="px-6 py-4 font-semibold text-[#7AAACE] dark:text-[#7AAACE]">
                                    {{ $gallery->event->title ?? 'Untitled Event' }}
                                </td>

                                <td class="px-6 py-4 font-medium text-[#355872] dark:text-[#DFD0B8]">
                                    {{ $gallery->caption }}
                                </td>

                                <td class="px-6 py-4">
                                    @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                                        <div class="flex space-x-4">
                                            <a href="{{ route('galleries.edit', $gallery) }}"
                                                class="font-medium text-[#7AAACE] dark:text-[#7AAACE] hover:text-[#9CD5FF] dark:hover:text-[#9CD5FF] transition">Edit</a>

                                            <form method="POST" action="{{ route('galleries.destroy', $gallery) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this image?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="font-medium text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="flex flex-col">
                                            <span
                                                class="text-xs text-[#7AAACE] dark:text-[#7AAACE] font-bold uppercase tracking-wider">صورة</span>
                                            <span class="text-[#948979] dark:text-[#948979] text-xs">نشرت:
                                                {{ $gallery->created_at->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-[#948979] dark:text-[#948979]">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-3 text-[#948979] dark:text-[#948979]" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p>No images found for any events yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($galleries, 'links'))
                <div class="mt-4">
                    {{ $galleries->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
