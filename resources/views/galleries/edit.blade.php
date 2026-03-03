<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-slate-900 dark:text-blue-700 leading-tight">
                {{ __('Edit Gallery') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.update', $gallery) }}" enctype="multipart/form-data"
                  class="p-8 bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="caption" class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">Caption</label>
                    <input type="text" id="caption" name="caption" value="{{ old('caption', $gallery->caption) }}"
                           class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                    @error('caption')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">Current Image</label>
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-lg shadow">
                    </div>

                    <label class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300" for="image">Update Image (Optional)</label>
                    <input class="block w-full text-sm text-slate-900 dark:text-slate-300 border border-slate-300 dark:border-slate-600 rounded-lg cursor-pointer bg-slate-50 dark:bg-slate-800 focus:outline-none file:bg-slate-200 dark:file:bg-slate-700 file:text-slate-700 dark:file:text-slate-300 file:border-0 file:py-3 file:px-5 file:mr-4 hover:file:bg-slate-300 dark:hover:file:bg-slate-600"
                           id="image" type="file" name="image">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('galleries.index') }}"
                       class="px-6 py-3 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-lg hover:bg-slate-300 dark:hover:bg-slate-600 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                        Update Gallery
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
