<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">
            إضافة صورة إلى معرض الفعالية
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data"
                class="p-8 lg:p-10 bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl shadow-xl border border-[#9CD5FF] dark:border-[#948979] space-y-8">
                @csrf

                <!-- الفعالية المرتبطة -->
                <div>
                    <label for="event_id"
                        class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]">الفعالية</label>
                    <select name="event_id" id="event_id" required
                        class="w-full px-5 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition">
                        <option value="">اختر الفعالية</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}"
                                {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- الشرح / التعليق -->
                <div>
                    <label for="caption"
                        class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]">الشرح / التعليق على
                        الصورة</label>
                    <input type="text" name="caption" id="caption" value="{{ old('caption') }}"
                        class="w-full px-5 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition">
                    @error('caption')
                        <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- رفع الصورة -->
                <div>
                    <label for="image"
                        class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]">الصورة</label>
                    <input type="file" name="image" id="image" accept="image/*" required
                        class="block w-full text-sm text-[#355872] dark:text-[#DFD0B8] border border-[#9CD5FF] dark:border-[#948979] rounded-2xl cursor-pointer bg-[#F7F8F0] dark:bg-[#393E46] focus:outline-none file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:bg-[#7AAACE] file:text-white hover:file:bg-[#9CD5FF] transition">
                    @error('image')
                        <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- الأزرار -->
                <div class="flex justify-end gap-4 pt-4 border-t border-[#9CD5FF] dark:border-[#948979]">
                    <a href="{{ route('galleries.index') }}"
                        class="px-8 py-4 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-2xl font-medium hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] transition shadow-sm hover:shadow-md">
                        إلغاء
                    </a>
                    <button type="submit"
                        class="px-10 py-4 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-2xl font-bold transition shadow-md hover:shadow-lg transform hover:scale-[1.02]">
                        إضافة الصورة
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
