<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-300 leading-tight">
                {{ __('Edit Gallery') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.update', $gallery) }}" enctype="multipart/form-data"
                class="p-6 bg-gray-900 rounded-xl shadow-2xl border border-gray-800 space-y-2">
                @csrf
                @method('PUT')
                <div>
                    <label for="caption" class="block mb-2 text-sm font-medium text-gray-400">Caption</label>
                    <input type="text" id="caption" name="caption"
                        class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 placeholder-gray-500"
                        value="{{ old('caption', $gallery->caption) }}">
                    @error('caption')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <img src="{{ asset('storage/' . $gallery->image) }}" class="w-20 h-20">

                    <label class="block mb-2 text-sm font-medium text-gray-400" for="file_input">Upload
                        file</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" type="file" name="image">
                    @error('image')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:ring-gray-500 font-medium rounded-lg text-sm px-6 py-3 transition duration-200 ease-in-out transform hover:scale-105 border border-gray-600">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
