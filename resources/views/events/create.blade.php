<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-slate-900 dark:text-blue-700 leading-tight">
                {{ __('New Event - Al-Hawash University') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data"
                  class="p-8 bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 space-y-6">
                @csrf

                <div class="grid gap-6 mb-8 md:grid-cols-2">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">العنوان</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                               class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="faculty_id" class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">الكلية</label>
                        <select id="faculty_id" name="faculty_id"
                                class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                            <option value="">اختر الكلية</option>
                            @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                                    {{ $faculty->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300" for="image">رفع صورة</label>
                        <input class="block w-full text-sm text-slate-900 dark:text-slate-300 border border-slate-300 dark:border-slate-600 rounded-lg cursor-pointer bg-slate-50 dark:bg-slate-800 focus:outline-none file:bg-slate-200 dark:file:bg-slate-700 file:text-slate-700 dark:file:text-slate-300 file:border-0 file:py-3 file:px-5 file:mr-4 hover:file:bg-slate-300 dark:hover:file:bg-slate-600"
                               id="image" type="file" name="image">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="num_tickets" class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">عدد التذاكر المتاحة</label>
                        <input type="number" id="num_tickets" name="num_tickets" value="{{ old('num_tickets') }}"
                               class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        @error('num_tickets')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">تاريخ البدء</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                               class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">تاريخ الانتهاء</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                               class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_time" class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">وقت البدء</label>
                        <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}"
                               class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        @error('start_time')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">الوصف</label>
                        <textarea id="description" name="description" rows="6"
                                  class="block p-3.5 w-full text-sm text-slate-900 dark:text-slate-100 bg-slate-50 dark:bg-slate-800 rounded-lg border border-slate-300 dark:border-slate-600 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="mb-4 text-lg font-semibold text-slate-900 dark:text-slate-100">التصنيفات (Tags)</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($tags as $tag)
                            <div class="flex items-center">
                                <input id="tag-{{ $tag->id }}" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                       class="w-5 h-5 text-blue-600 bg-slate-100 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded focus:ring-blue-500">
                                <label for="tag-{{ $tag->id }}" class="ms-2 text-sm font-medium text-slate-700 dark:text-slate-300">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="px-8 py-4 bg-blue-700 hover:bg-blue-800 text-white rounded-lg font-medium transition shadow-md hover:shadow-lg">
                        إنشاء الفعالية
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
