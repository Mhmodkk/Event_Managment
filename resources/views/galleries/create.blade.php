<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-slate-900 dark:text-blue-700 leading-tight">
                {{ __('New Gallery') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data"
                class="p-8 bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 space-y-6">
                @csrf

                <div>
                    <label for="caption"
                        class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">Caption</label>
                    <input type="text" id="caption" name="caption" value="{{ old('caption') }}"
                        class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                    @error('caption')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="event_id"
                        class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">الفعالية</label>
                    <select id="event_id" name="event_id" required
                        class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        <option value="">اختر الفعالية</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300"
                        for="image">Upload Image</label>
                    <input
                        class="block w-full text-sm text-slate-900 dark:text-slate-300 border border-slate-300 dark:border-slate-600 rounded-lg cursor-pointer bg-slate-50 dark:bg-slate-800 focus:outline-none file:bg-slate-200 dark:file:bg-slate-700 file:text-slate-700 dark:file:text-slate-300 file:border-0 file:py-3 file:px-5 file:mr-4 hover:file:bg-slate-300 dark:hover:file:bg-slate-600"
                        id="image" type="file" name="image">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-8 py-4 bg-blue-700 hover:bg-blue-800 text-white rounded-lg font-medium transition shadow-md hover:shadow-lg">
                        Create Gallery
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
