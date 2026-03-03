<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-slate-900 dark:text-blue-700 leading-tight">
                {{ __('Gallery Archive') }}
            </h2>
            <div>
                @if (auth()->user()->isOrganizer())
                    <a href="{{ route('galleries.create') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-500/50 font-medium rounded-lg text-sm px-6 py-3 transition duration-200 ease-in-out transform hover:scale-105 border border-blue-600">
                        + New Gallery
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-slate-900 overflow-hidden shadow-lg sm:rounded-2xl border border-slate-200 dark:border-slate-700">
                <table class="w-full text-sm text-left text-slate-600 dark:text-slate-300">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-800 dark:text-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-6 py-3">Event Name</th>
                            <th scope="col" class="px-6 py-3">Caption</th>
                            <th scope="col" class="px-6 py-3">
                                {{ auth()->user()->isOrganizer() ? 'Actions' : 'Information' }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $gallery)
                            <tr
                                class="bg-white border-b dark:bg-slate-900 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                {{-- عمود الصورة --}}
                                <td class="px-6 py-4">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->caption }}"
                                        class="w-20 h-20 object-cover rounded-lg shadow-sm border border-slate-100 dark:border-slate-600">
                                </td>

                                {{-- عمود اسم الفعالية --}}
                                <td class="px-6 py-4 font-semibold text-blue-600 dark:text-blue-400">
                                    {{ $gallery->event->title ?? 'Untitled Event' }}
                                </td>

                                {{-- عمود الوصف --}}
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-slate-100">
                                    {{ $gallery->caption }}
                                </td>

                                {{-- عمود الإجراءات أو المعلومات --}}
                                <td class="px-6 py-4">
                                    @if (auth()->user()->isOrganizer())
                                        <div class="flex space-x-4">
                                            <a href="{{ route('galleries.edit', $gallery) }}"
                                                class="font-medium text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 transition">Edit</a>

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
                                                class="text-xs text-blue-600 dark:text-blue-400 font-bold uppercase tracking-wider">Gallery
                                                Item</span>
                                            <span class="text-slate-500 dark:text-slate-400 text-xs">Published:
                                                {{ $gallery->created_at->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-3 text-slate-400 dark:text-slate-500" fill="none"
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
