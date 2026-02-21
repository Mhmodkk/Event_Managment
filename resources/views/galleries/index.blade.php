<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gallery') }}
            </h2>
            <div>
                {{-- زر إضافة معرض جديد يظهر للمنظم فقط --}}
                @if (auth()->user()->isOrganizer())
                    <a href="{{ route('galleries.create') }}"
                        class="text-white bg-indigo-700 hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-500 font-medium rounded-lg text-sm px-6 py-3 transition duration-200 ease-in-out transform hover:scale-105 border border-indigo-600">
                        + New Gallery
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-hidden shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-6 py-3">Caption</th>
                            <th scope="col" class="px-6 py-3">
                                {{ auth()->user()->isOrganizer() ? 'Actions' : 'Information' }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $gallery)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" class="w-20 h-20 object-cover rounded-lg shadow">
                                </td>
                                <td class="px-6 py-4 font-medium">
                                    {{ $gallery->caption }}
                                </td>
                                <td class="px-6 py-4">
                                    @if (auth()->user()->isOrganizer())
                                        {{-- خيارات المنظم: تعديل وحذف --}}
                                        <div class="flex space-x-4">
                                            <a href="{{ route('galleries.edit', $gallery) }}"
                                                class="font-medium text-green-500 dark:text-green-400 hover:underline">Edit</a>
                                            <form method="POST" action="{{ route('galleries.destroy', $gallery) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this image?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-500 dark:text-red-400 hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        {{-- خيارات الطالب: عرض معلومات الفعالية --}}
                                        <div class="flex flex-col">
                                            <span class="text-xs text-indigo-400 font-bold uppercase tracking-wider">Past Event</span>
                                            <span class="text-gray-400 text-xs">Published: {{ $gallery->created_at->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p>No Gallery found in the archive.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
