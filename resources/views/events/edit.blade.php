<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">تعديل الفعالية</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data"
                class="p-8 md:p-10 bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl shadow-xl border border-[#9CD5FF] dark:border-[#948979] space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-bold text-[#948979]">العنوان</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-xl focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4 transition">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block mb-2 text-sm font-bold text-[#948979]">نوع الفعالية</label>
                        <select name="type" id="type"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-xl focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4 transition">
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
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block mb-2 text-sm font-bold text-[#948979]">المكان</label>
                        <input type="text" name="location" id="location"
                            value="{{ old('location', $event->location) }}"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-xl focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4 transition"
                            placeholder="قاعة 101 أو رابط أونلاين">
                        @error('location')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-bold text-[#948979]">تاريخ
                            البداية</label>
                        <input type="date" name="start_date" id="start_date"
                            value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-xl focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4 transition">
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-bold text-[#948979]">تاريخ النهاية</label>
                        <input type="date" name="end_date" id="end_date"
                            value="{{ old('end_date', $event->end_date->format('Y-m-d')) }}"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-xl focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4 transition">
                        @error('end_date')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_time" class="block mb-2 text-sm font-bold text-[#948979]">وقت البداية</label>
                        <input type="time" name="start_time" id="start_time"
                            value="{{ old('start_time', $event->start_time) }}"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-xl focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4 transition">
                        @error('start_time')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="num_tickets" class="block mb-2 text-sm font-bold text-[#948979]">عدد التذاكر
                            المتاحة</label>
                        <input type="number" name="num_tickets" id="num_tickets"
                            value="{{ old('num_tickets', $event->num_tickets) }}"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-xl focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4 transition">
                        @error('num_tickets')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="faculty_id" class="block mb-2 text-sm font-bold text-[#948979]">الكلية</label>
                        <select name="faculty_id" id="faculty_id"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-xl focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4 transition">
                            @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}"
                                    {{ old('faculty_id', $event->faculty_id) == $faculty->id ? 'selected' : '' }}>
                                    {{ $faculty->name }}</option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-bold text-[#948979]">الوصف</label>
                        <textarea name="description" id="description" rows="6"
                            class="block p-4 w-full text-sm text-[#355872] dark:text-[#DFD0B8] bg-[#F7F8F0] dark:bg-[#393E46] rounded-xl border border-[#9CD5FF] dark:border-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] transition">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-bold text-[#948979]">أيام العطل المستثناة
                            (اختياري)</label>
                        <div class="flex gap-3">
                            <input type="date" id="excluded_days_input"
                                class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-xl focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4 transition">
                            <button type="button" id="add_excluded_day"
                                class="px-5 py-3 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-xl font-bold hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] transition">إضافة</button>
                        </div>
                        <div id="excluded_days_list" class="mt-3 flex flex-wrap gap-2">
                            @if ($event->excluded_days && count(json_decode($event->excluded_days, true)) > 0)
                                @foreach (json_decode($event->excluded_days, true) as $day)
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-full text-sm font-medium shadow-sm">
                                        {{ \Carbon\Carbon::parse($day)->format('Y-m-d') }}
                                        <button type="button"
                                            class="ml-2 text-[#7AAACE] dark:text-[#7AAACE] hover:text-red-500 font-bold"
                                            onclick="removeDate('{{ $day }}')">×</button>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                        <input type="hidden" name="excluded_days_json" id="excluded_days_json"
                            value="{{ $event->excluded_days ?? '[]' }}">
                        @error('excluded_days.*')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div
                        class="md:col-span-2 flex items-center gap-3 p-4 bg-[#F7F8F0] dark:bg-[#393E46] rounded-xl border border-[#9CD5FF] dark:border-[#948979]">
                        <input type="checkbox" name="is_public" id="is_public" value="1"
                            {{ old('is_public', $event->is_public) ? 'checked' : '' }}
                            class="w-5 h-5 text-[#7AAACE] bg-[#F7F8F0] border-[#9CD5FF] rounded focus:ring-[#7AAACE] transition">
                        <label for="is_public" class="ms-2 text-sm font-medium text-[#948979]">الفعالية مفتوحة للجمهور
                            والضيوف الخارجيين</label>
                    </div>

                    <div class="md:col-span-2">
                        <label for="image" class="block mb-2 text-sm font-bold text-[#948979]">صورة الفعالية
                            (اختياري)</label>
                        @if ($event->image)
                            <div
                                class="mb-4 flex items-center gap-4 p-4 bg-[#F7F8F0] dark:bg-[#393E46] rounded-xl border border-[#9CD5FF] dark:border-[#948979]">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="الصورة الحالية"
                                    class="w-24 h-24 object-cover rounded-lg border-2 border-[#7AAACE]">
                                <p class="text-sm text-[#948979]">الصورة الحالية (سيتم استبدالها عند رفع جديدة)</p>
                            </div>
                        @endif
                        <input type="file" name="image" id="image"
                            class="block w-full text-sm text-[#355872] dark:text-[#DFD0B8] border border-[#9CD5FF] dark:border-[#948979] rounded-xl cursor-pointer bg-[#F7F8F0] dark:bg-[#393E46] focus:outline-none file:bg-[#9CD5FF] dark:file:bg-[#948979] file:text-[#355872] dark:file:text-[#DFD0B8] file:border-0 file:py-3 file:px-5 file:mr-4 hover:file:bg-[#7AAACE] dark:hover:file:bg-[#DFD0B8] transition">
                        @error('image')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-bold text-[#948979]">التصنيفات (Tags)</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($tags as $tag)
                                <div
                                    class="flex items-center p-3 bg-[#F7F8F0] dark:bg-[#393E46] rounded-lg border border-[#9CD5FF] dark:border-[#948979] hover:border-[#7AAACE] transition">
                                    <input id="tag-{{ $tag->id }}" type="checkbox" name="tags[]"
                                        value="{{ $tag->id }}"
                                        class="w-5 h-5 text-[#7AAACE] bg-[#F7F8F0] border-[#9CD5FF] dark:bg-[#393E46] dark:border-[#948979] rounded focus:ring-[#7AAACE]"
                                        {{ in_array($tag->id, old('tags', $event->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <label for="tag-{{ $tag->id }}"
                                        class="ms-2 text-sm font-medium text-[#948979]">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('tags')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-[#9CD5FF] dark:border-[#948979]">
                    <a href="{{ route('events.index') }}"
                        class="px-6 py-3 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-xl font-bold hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] transition">إلغاء</a>
                    <button type="submit"
                        class="px-8 py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white font-bold rounded-xl transition duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.02]">تحديث
                        الفعالية</button>
                </div>
            </form>
        </div>
    </div>

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
                        'inline-flex items-center px-3 py-1.5 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-full text-sm font-medium shadow-sm';
                    tag.innerHTML =
                        `${value} <button type="button" class="ml-2 text-[#7AAACE] dark:text-[#7AAACE] hover:text-red-500 font-bold" onclick="removeDate('${value}')">×</button>`;
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
</x-main-layout>
