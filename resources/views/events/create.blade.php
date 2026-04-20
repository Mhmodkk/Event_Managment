<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8] leading-tight">
                إنشاء فعالية جديدة
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data"
                class="p-8 md:p-12 bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl shadow-xl border border-[#9CD5FF] dark:border-[#948979] space-y-8">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- العنوان -->
                    <div class="md:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-[#948979]">عنوان الفعالية <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-2xl focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- نوع الفعالية -->
                    <div>
                        <label for="type" class="block mb-2 text-sm font-medium text-[#948979]">نوع الفعالية <span
                                class="text-red-500">*</span></label>
                        <select name="type" id="type"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-2xl focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4">
                            <option value="">اختر النوع</option>
                            <option value="workshop" {{ old('type') == 'workshop' ? 'selected' : '' }}>ورشة عمل</option>
                            <option value="course" {{ old('type') == 'course' ? 'selected' : '' }}>دورة تدريبية</option>
                            <option value="lecture" {{ old('type') == 'lecture' ? 'selected' : '' }}>محاضرة علمية
                            </option>
                            <option value="orientation" {{ old('type') == 'orientation' ? 'selected' : '' }}>محاضرة
                                تعريفية</option>
                            <option value="party" {{ old('type') == 'party' ? 'selected' : '' }}>حفلة تعارف</option>
                            <option value="trip" {{ old('type') == 'trip' ? 'selected' : '' }}>رحلة علمية</option>
                            <option value="exhibition" {{ old('type') == 'exhibition' ? 'selected' : '' }}>معرض</option>
                            <option value="sports" {{ old('type') == 'sports' ? 'selected' : '' }}>فعالية رياضية
                            </option>
                            <option value="hackathon" {{ old('type') == 'hackathon' ? 'selected' : '' }}>مسابقة
                                علمية/برمجية</option>
                            <option value="job_fair" {{ old('type') == 'job_fair' ? 'selected' : '' }}>ندوة توظيف
                            </option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- المكان -->
                    <div>
                        <label for="location" class="block mb-2 text-sm font-medium text-[#948979]">المكان <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-2xl focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4"
                            placeholder="قاعة 101 أو رابط أونلاين">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- تاريخ ووقت البداية -->
                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-medium text-[#948979]">تاريخ ووقت البداية
                            <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-2xl focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- تاريخ ووقت النهاية -->
                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-medium text-[#948979]">تاريخ ووقت النهاية
                            <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-2xl focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4">
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- عدد التذاكر -->
                    <div>
                        <label for="num_tickets" class="block mb-2 text-sm font-medium text-[#948979]">عدد التذاكر
                            المتاحة</label>
                        <input type="number" name="num_tickets" id="num_tickets" value="{{ old('num_tickets', 50) }}"
                            min="1"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-2xl focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4">
                        @error('num_tickets')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- الكلية -->
                    <div>
                        <label for="faculty_id" class="block mb-2 text-sm font-medium text-[#948979]">الكلية <span
                                class="text-red-500">*</span></label>
                        <select name="faculty_id" id="faculty_id"
                            class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-2xl focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4">
                            <option value="">اختر الكلية</option>
                            @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}"
                                    {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                                    {{ $faculty->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('faculty_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- الوصف -->
                    <div class="md:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-[#948979]">الوصف <span
                                class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="5"
                            class="block p-4 w-full text-sm text-[#355872] dark:text-[#DFD0B8] bg-[#F7F8F0] dark:bg-[#393E46] rounded-2xl border border-[#9CD5FF] dark:border-[#948979] focus:ring-[#7AAACE] focus:border-[#7AAACE]">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- أيام العطل المستثناة -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-[#948979]">أيام العطل المستثناة
                            (اختياري)</label>
                        <div class="flex gap-3">
                            <input type="date" id="excluded_days_input"
                                class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-2xl focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-4">
                            <button type="button" id="add_excluded_day"
                                class="px-6 py-4 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-2xl hover:bg-[#7AAACE] transition">
                                إضافة
                            </button>
                        </div>
                        <div id="excluded_days_list" class="mt-4 flex flex-wrap gap-2"></div>
                        <input type="hidden" name="excluded_days_json" id="excluded_days_json">
                    </div>

                    <!-- مفتوحة للجمهور -->
                    <div class="md:col-span-2 flex items-center gap-3">
                        <input type="checkbox" name="is_public" id="is_public" value="1"
                            {{ old('is_public') ? 'checked' : '' }}
                            class="w-5 h-5 text-[#7AAACE] bg-[#F7F8F0] border-[#9CD5FF] rounded focus:ring-[#7AAACE]">
                        <label for="is_public" class="text-sm font-medium text-[#948979]">
                            الفعالية مفتوحة للجمهور والضيوف الخارجيين
                        </label>
                    </div>

                    <!-- صورة الفعالية -->
                    <div class="md:col-span-2">
                        <label for="image" class="block mb-2 text-sm font-medium text-[#948979]">صورة
                            الفعالية</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="block w-full text-sm text-[#355872] border border-[#9CD5FF] dark:border-[#948979] rounded-2xl cursor-pointer bg-[#F7F8F0] dark:bg-[#393E46] file:mr-4 file:py-4 file:px-6 file:rounded-2xl file:border-0 file:bg-[#7AAACE] file:text-white hover:file:bg-[#9CD5FF]">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- التصنيفات -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-[#948979]">التصنيفات (Tags)</label>

                        <div class="flex gap-3 mb-4">
                            <input type="text" id="new_tag_input"
                                class="flex-1 bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-2xl focus:ring-[#7AAACE] focus:border-[#7AAACE] p-4"
                                placeholder="أدخل تصنيف جديد (مثال: AI, Robotics...)">
                            <button type="button" id="add_tag_btn"
                                class="px-6 py-4 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-2xl transition">
                                إضافة
                            </button>
                        </div>

                        <div id="tags_list" class="flex flex-wrap gap-2 mb-6"></div>
                        <input type="hidden" name="tags" id="tags_hidden">

                        <div class="text-xs text-[#948979] mb-2">أو اختر من التصنيفات الموجودة:</div>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($tags as $tag)
                                <div class="flex items-center">
                                    <input type="checkbox" id="tag-{{ $tag->id }}" name="existing_tags[]"
                                        value="{{ $tag->id }}"
                                        class="w-5 h-5 text-[#7AAACE] bg-[#F7F8F0] border-[#9CD5FF] rounded focus:ring-[#7AAACE]">
                                    <label for="tag-{{ $tag->id }}" class="ms-2 text-sm text-[#948979]">
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

                <div class="flex justify-end gap-4 pt-8">
                    <a href="{{ route('events.index') }}"
                        class="px-8 py-4 text-[#355872] dark:text-[#DFD0B8] hover:bg-[#F7F8F0] dark:hover:bg-[#393E46] rounded-2xl transition">
                        إلغاء
                    </a>
                    <button type="submit"
                        class="px-10 py-4 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white font-medium rounded-2xl shadow-md hover:shadow-lg transition">
                        إنشاء الفعالية
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
        let dates = [];

        addBtn.addEventListener('click', () => {
            const value = input.value.trim();
            if (value && !dates.includes(value)) {
                dates.push(value);
                const tag = document.createElement('span');
                tag.className =
                    'inline-flex items-center px-4 py-2 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-2xl text-sm';
                tag.innerHTML =
                    `${value} <button type="button" class="ml-3 text-red-500 hover:text-red-700" onclick="removeDate('${value}')">×</button>`;
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('new_tag_input');
        const addBtn = document.getElementById('add_tag_btn');
        const list = document.getElementById('tags_list');
        const hidden = document.getElementById('tags_hidden');
        let tagsArray = [];

        function renderTags() {
            list.innerHTML = '';
            tagsArray.forEach((tag, index) => {
                const pill = document.createElement('span');
                pill.className =
                    'inline-flex items-center px-4 py-2 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-2xl text-sm';
                pill.innerHTML = `
                    ${tag}
                    <button type="button" class="ml-3 text-red-500 hover:text-red-700" onclick="removeTag(${index})">×</button>
                `;
                list.appendChild(pill);
            });
            hidden.value = JSON.stringify(tagsArray);
        }

        window.removeTag = function(index) {
            tagsArray.splice(index, 1);
            renderTags();
        };

        addBtn.addEventListener('click', () => {
            const value = input.value.trim();
            if (value && !tagsArray.includes(value)) {
                tagsArray.push(value);
                renderTags();
                input.value = '';
            }
        });

        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                addBtn.click();
            }
        });
    });
</script>
