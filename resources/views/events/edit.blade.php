<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Event') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data"
                  class="p-8 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                @csrf
                @method('PUT')

                <div class="grid gap-6 mb-8 md:grid-cols-2">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}"
                               class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="faculty_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Faculty</label>
                        <select id="faculty_id" name="faculty_id"
                                class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                            @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}" {{ old('faculty_id', $event->faculty_id) == $faculty->id ? 'selected' : '' }}>
                                    {{ $faculty->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Address (Room/Hall)</label>
                        <input type="text" id="address" name="address" value="{{ old('address', $event->address) }}"
                               class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                        @error('address')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="num_tickets" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tickets Available</label>
                        <input type="number" id="num_tickets" name="num_tickets" value="{{ old('num_tickets', $event->num_tickets) }}"
                               class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                        @error('num_tickets')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300" for="image">Update Image (Optional)</label>
                        <input class="block w-full text-sm text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 focus:outline-none file:bg-gray-200 dark:file:bg-gray-600 file:text-gray-700 dark:file:text-gray-300 file:border-0 file:py-2.5 file:px-4 file:mr-4 hover:file:bg-gray-300 dark:hover:file:bg-gray-500"
                               id="image" type="file" name="image">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        @if ($event->image)
                            <img src="{{ Storage::url($event->image) }}" alt="Current Image" class="mt-2 h-32 w-auto rounded-lg">
                        @endif
                    </div>

                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}"
                               class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="description" name="description" rows="5"
                                  class="block p-3 w-full text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-200">Tags</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($tags as $tag)
                            <div class="flex items-center">
                                <input id="tag-{{ $tag->id }}" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                       class="w-5 h-5 text-indigo-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500"
                                       {{ $event->tags->contains($tag->id) ? 'checked' : '' }}>
                                <label for="tag-{{ $tag->id }}" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('events.index') }}"
                       class="px-6 py-3 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition duration-200">
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
