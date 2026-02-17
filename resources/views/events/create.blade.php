<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-300 leading-tight">
                {{ __('New Event - Al-Hawash University') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data"
                class="p-6 bg-gray-900 rounded-xl shadow-2xl border border-gray-800">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-400">Title</label>
                        <input type="text" id="title" name="title"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 placeholder-gray-500"
                            placeholder="Event Title">
                        @error('title')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="faculty_id" class="block mb-2 text-sm font-medium text-gray-400">Select Faculty</label>
                        <select id="faculty_id" name="faculty_id"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5">
                            <option value="">Choose a Faculty</option>
                            @foreach ($faculties as $faculty)
                                <option class="bg-gray-800 text-gray-200" value="{{ $faculty->id }}">
                                    {{ $faculty->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-400" for="file_input">Upload Image</label>
                        <input
                            class="block w-full text-sm text-gray-300 border border-gray-700 rounded-lg cursor-pointer bg-gray-800 focus:outline-none file:bg-gray-700 file:text-gray-300 file:border-0 file:py-2 file:px-4 file:mr-4 file:hover:bg-gray-600"
                            id="file_input" type="file" name="image">
                        @error('image')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="num_tickets" class="block mb-2 text-sm font-medium text-gray-400">Tickets Available</label>
                        <input type="number" id="num_tickets" name="num_tickets"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5"
                            placeholder="1">
                        @error('num_tickets')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-400">Start Date</label>
                        <input type="date" id="start_date" name="start_date"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5">
                        @error('start_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-400">End Date</label>
                        <input type="date" id="end_date" name="end_date"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5">
                        @error('end_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="start_time" class="block mb-2 text-sm font-medium text-gray-400">Start Time</label>
                        <input type="time" id="start_time" name="start_time"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5">
                        @error('start_time')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-400">Description</label>
                        <textarea id="description" name="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-200 bg-gray-800 rounded-lg border border-gray-700 focus:ring-gray-600 focus:border-gray-600 placeholder-gray-500"
                            placeholder="Enter event details..."></textarea>
                        @error('description')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <h3 class="mb-4 font-semibold text-white">Tags</h3>
                    <ul class="items-center w-full text-sm font-medium text-gray-200 bg-gray-800 border border-gray-700 rounded-lg sm:flex">
                        @foreach ($tags as $tag)
                            <li class="w-full border-b border-gray-700 sm:border-b-0 sm:border-r">
                                <div class="flex items-center pl-3">
                                    <input id="tag-{{ $tag->id }}" type="checkbox" name="tags[]"
                                        value="{{ $tag->id }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500">
                                    <label for="tag-{{ $tag->id }}"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-300">{{ $tag->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="text-white bg-indigo-700 hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-500 font-medium rounded-lg text-sm px-6 py-3 transition duration-200">
                        Create Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
