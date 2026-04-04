<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8] leading-tight">
                {{ __('New Gallery') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data"
                class="p-8 bg-[#F7F8F0] dark:bg-[#393E46] rounded-2xl shadow-xl border border-[#9CD5FF] dark:border-[#948979] space-y-6">
                @csrf

                <div>
                    <label for="caption"
                        class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]">Caption</label>
                    <input type="text" id="caption" name="caption" value="{{ old('caption') }}"
                        class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-lg focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-3.5">
                    @error('caption')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="event_id"
                        class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]">الفعالية</label>
                    <select id="event_id" name="event_id" required
                        class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-lg focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-3.5">
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
                    <label class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]"
                        for="image">Upload Image</label>
                    <input
                        class="block w-full text-sm text-[#355872] dark:text-[#DFD0B8] border border-[#9CD5FF] dark:border-[#948979] rounded-lg cursor-pointer bg-[#F7F8F0] dark:bg-[#393E46] focus:outline-none file:bg-[#9CD5FF] dark:file:bg-[#948979] file:text-[#355872] dark:file:text-[#DFD0B8] file:border-0 file:py-3 file:px-5 file:mr-4 hover:file:bg-[#7AAACE] dark:hover:file:bg-[#DFD0B8]"
                        id="image" type="file" name="image">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-8 py-4 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-lg font-medium transition shadow-md hover:shadow-lg">
                        Create Gallery
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
