<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-slate-900 dark:text-blue-100 leading-tight">
                {{ __('تعديل الفعالية') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data"
                class="p-8 bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="md:col-span-2">
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">العنوان</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}"
                            class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type"
                            class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">نوع
                            الفعالية</label>
                        <select name="type" id="type"
                            class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                            <option value="">اختر النوع</option>
                            <option value="workshop" {{ old('type', $event->type) == 'workshop' ? 'selected' : '' }}>
                                ورشة عمل</option>
                            <option value="course" {{ old('type', $event->type) == 'course' ? 'selected' : '' }}>دورة
                                تدريبية</option>
                            <option value="lecture" {{ old('type', $event->type) == 'lecture' ? 'selected' : '' }}>
                                محاضرة علمية</option>
                            <option value="orientation"
                                {{ old('type', $event->type) == 'orientation' ? 'selected' : '' }}>محاضرة تعريفية
                            </option>
                            <option value="party" {{ old('type', $event->type) == 'party' ? 'selected' : '' }}>حفلة
                                تعارف</option>
                            <option value="trip" {{ old('type', $event->type) == 'trip' ? 'selected' : '' }}>رحلة
                                علمية</option>
                            <option value="exhibition"
                                {{ old('type', $event->type) == 'exhibition' ? 'selected' : '' }}>معرض</option>
                            <option value="sports" {{ old('type', $event->type) == 'sports' ? 'selected' : '' }}>فعالية
                                رياضية</option>
                            <option value="hackathon" {{ old('type', $event->type) == 'hackathon' ? 'selected' : '' }}>
                                مسابقة علمية/برمجية</option>
                            <option value="job_fair" {{ old('type', $event->type) == 'job_fair' ? 'selected' : '' }}>
                                ندوة توظيف</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location"
                            class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">المكان</label>
                        <input type="text" name="location" id="location"
                            value="{{ old('location', $event->location) }}"
                            class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5"
                            placeholder="قاعة 101 أو رابط أونلاين">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_date"
                            class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">تاريخ
                            البداية</label>
                        <input type="date" name="start_date" id="start_date"
                            value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}"
                            class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date"
                            class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">تاريخ
                            النهاية</label>
                        <input type="date" name="end_date" id="end_date"
                            value="{{ old('end_date', $event->end_date->format('Y-m-d')) }}"
                            class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_time"
                            class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">وقت
                            البداية</label>
                        <input type="time" name="start_time" id="start_time"
                            value="{{ old('start_time', $event->start_time) }}"
                            class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        @error('start_time')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="num_tickets"
                            class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">عدد التذاكر
                            المتاحة</label>
                        <input type="number" name="num_tickets" id="num_tickets"
                            value="{{ old('num_tickets', $event->num_tickets) }}"
                            class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                        @error('num_tickets')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="faculty_id"
                            class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">الكلية</label>
                        <select name="faculty_id" id="faculty_id"
                            class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                            @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}"
                                    {{ old('faculty_id', $event->faculty_id) == $faculty->id ? 'selected' : '' }}>
                                    {{ $faculty->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">الوصف</label>
                        <textarea name="description" id="description" rows="6"
                            class="block p-3.5 w-full text-sm text-slate-900 dark:text-slate-100 bg-slate-50 dark:bg-slate-800 rounded-lg border border-slate-300 dark:border-slate-600 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">أيام العطل
                            المستثناة (اختياري)</label>
                        <div class="flex gap-3">
                            <input type="date" id="excluded_days_input"
                                class="bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-900 dark:text-slate-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5">
                            <button type="button" id="add_excluded_day"
                                class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-lg hover:bg-slate-300 dark:hover:bg-slate-600 transition">
                                إضافة
                            </button>
                        </div>
                        <div id="excluded_days_list" class="mt-3 flex flex-wrap gap-2">
                            @if ($event->excluded_days && count(json_decode($event->excluded_days, true)) > 0)
                                @foreach (json_decode($event->excluded_days, true) as $day)
                                    <span
                                        class="inline-flex items-center px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm">
                                        {{ \Carbon\Carbon::parse($day)->format('Y-m-d') }}
                                        <button type="button"
                                            class="ml-2 text-blue-600 dark:text-blue-300 hover:text-blue-800"
                                            onclick="removeDate('{{ $day }}')">×</button>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                        <input type="hidden" name="excluded_days_json" id="excluded_days_json"
                            value="{{ $event->excluded_days ?? '[]' }}">
                        @error('excluded_days.*')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 flex items-center">
                        <input type="checkbox" name="is_public" id="is_public" value="1"
                            {{ old('is_public', $event->is_public) ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600">
                        <label for="is_public" class="ms-2 text-sm font-medium text-slate-700 dark:text-slate-300">
                            الفعالية مفتوحة للجمهور والضيوف الخارجيين
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <label for="image"
                            class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">صورة الفعالية
                            (اختياري)</label>
                        @if ($event->image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="الصورة الحالية"
                                    class="w-48 h-48 object-cover rounded-lg border border-slate-300 dark:border-slate-600">
                                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">الصورة الحالية</p>
                            </div>
                        @endif
                        <input type="file" name="image" id="image"
                            class="block w-full text-sm text-slate-900 dark:text-slate-300 border border-slate-300 dark:border-slate-600 rounded-lg cursor-pointer bg-slate-50 dark:bg-slate-800 focus:outline-none file:bg-slate-200 dark:file:bg-slate-700 file:text-slate-700 dark:file:text-slate-300 file:border-0 file:py-3 file:px-5 file:mr-4 hover:file:bg-slate-300 dark:hover:file:bg-slate-600">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-slate-700 dark:text-slate-300">التصنيفات
                            (Tags)</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($tags as $tag)
                                <div class="flex items-center">
                                    <input id="tag-{{ $tag->id }}" type="checkbox" name="tags[]"
                                        value="{{ $tag->id }}"
                                        class="w-5 h-5 text-blue-600 bg-slate-100 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded focus:ring-blue-500"
                                        {{ old('tags', $event->tags->pluck('id')->toArray()) && in_array($tag->id, old('tags', $event->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <label for="tag-{{ $tag->id }}"
                                        class="ms-2 text-sm font-medium text-slate-700 dark:text-slate-300">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('tags')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('events.index') }}"
                        class="px-6 py-3 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-lg hover:bg-slate-300 dark:hover:bg-slate-600 transition">
                        إلغاء
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                        تحديث الفعالية
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('excluded_days_input');
        const addBtn = document.getElementById('add_excluded_day');
        const list = document.getElementById('excluded_days_list');
        const hidden = document.getElementById('excluded_days_json');
        let dates = JSON.parse(hidden.value || '[]');

        addBtn.addEventListener('click', () => {
            const value = input.value.trim();
            if (value && !dates.includes(value)) {
                dates.push(value);
                const tag = document.createElement('span');
                tag.className =
                    'inline-flex items-center px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm';
                tag.innerHTML =
                    `${value} <button type="button" class="ml-2 text-blue-600 dark:text-blue-300 hover:text-blue-800" onclick="removeDate('${value}')">×</button>`;
                list.appendChild(tag);
                hidden.value = JSON.stringify(dates);
                input.value = '';
            }
        });

        window.removeDate = function(date) {
            dates = dates.filter(d => d !== date);
            hidden.value = JSON.stringify(dates);
            const tags = list.querySelectorAll('span');
            tags.forEach(tag => {
                if (tag.textContent.includes(date)) tag.remove();
            });
        };
    });
</script>
