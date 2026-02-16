<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-300 leading-tight">
                {{ __('Edit Event') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('events.update', $event) }}" x-data="{
                country: null,
                cityId: @js($event->city_id),
                cities: @js($event->country->cities),
                onCountryChange(event) {
                    axios.get(`/countries/${event.target.value}`).then(res => {
                        this.cities = res.data
                    })
                }
            }"
                enctype="multipart/form-data" class="p-6 bg-gray-900 rounded-xl shadow-2xl border border-gray-800">
                @csrf
                @method('PUT')
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-400">Title</label>
                        <input type="text" id="title" name="title"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 placeholder-gray-500"
                            value="{{ old('title', $event->title) }}">
                        @error('title')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="country_id" class="block mb-2 text-sm font-medium text-gray-400">Select an
                            option</label>
                        <select id="country_id" x-on:change="onCountryChange" name="country_id"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5">
                            <option class="bg-gray-800 text-gray-400">Choose a country</option>
                            @foreach ($countries as $country)
                                <option class="bg-gray-800 text-gray-200" value="{{ $country->id }}" @selected($country->id === $event->country_id)>
                                    {{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="city_id" class="block mb-2 text-sm font-medium text-gray-400">Select an
                            option</label>
                        <select id="city_id" name="city_id"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5">
                            <template x-for="city in cities" :key="city.id">
                                <option class="bg-gray-800 text-gray-200" x-bind:value="city.id"
                                    x-text="city.name" :selected="city.id === cityId"></option>
                            </template>
                        </select>
                        @error('city_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-400">Address</label>
                        <input type="text" id="address" name="address"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 placeholder-gray-500"
                            value="{{ old('address', $event->address) }}">
                        @error('address')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-400" for="file_input">Upload file</label>
                        <input
                            class="block w-full text-sm text-gray-300 border border-gray-700 rounded-lg cursor-pointer bg-gray-800 focus:outline-none file:bg-gray-700 file:text-gray-300 file:border-0 file:py-2 file:px-4 file:mr-4 file:hover:bg-gray-600"
                            id="file_input" type="file" name="image">
                        @error('image')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-400">Start Date</label>
                        <input type="date" id="start_date" name="start_date"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5"
                            value="{{ old('start_date', $event->start_date) }}">
                        @error('start_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-400">End Date</label>
                        <input type="date" id="end_date" name="end_date"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5"
                            value="{{ old('end_date', $event->end_date) }}">
                        @error('end_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="start_time" class="block mb-2 text-sm font-medium text-gray-400">Start Time</label>
                        <input type="time" id="start_time" name="start_time"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5"
                            value="{{ old('start_time', $event->start_time) }}">
                        @error('start_time')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="num_tickets" class="block mb-2 text-sm font-medium text-gray-400">Nr:
                            Tickets</label>
                        <input type="number" id="num_tickets" name="num_tickets"
                            class="bg-gray-800 border border-gray-700 text-gray-200 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5"
                            value="{{ old('num_tickets', $event->num_tickets) }}">
                        @error('num_tickets')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-400">Description</label>
                        <textarea id="description" name="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-200 bg-gray-800 rounded-lg border border-gray-700 focus:ring-gray-600 focus:border-gray-600 placeholder-gray-500"
                            >{{$event->description}}</textarea>
                        @error('description')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Tags</h3>
                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($tags as $tag)
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="vue-checkbox-list" type="checkbox" name="tags[]"
                                        value="{{ $tag->id }}" @checked($event->hasTags($tag))
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="vue-checkbox-list"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tag->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:ring-gray-500 font-medium rounded-lg text-sm px-6 py-3 transition duration-200 ease-in-out transform hover:scale-105 border border-gray-600">Update
                        Event</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
