<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">تعديل صورة في المعرض</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.update', $gallery) }}" enctype="multipart/form-data"
                class="p-8 lg:p-10 bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl shadow-xl border border-[#9CD5FF] dark:border-[#948979] space-y-8">
                @csrf
                @method('PUT')

                <!-- الشرح / التعليق -->
                <div>
                    <label for="caption" class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]">الشرح
                        / التعليق</label>
                    <input type="text" id="caption" name="caption" value="{{ old('caption', $gallery->caption) }}"
                        class="w-full px-5 py-4 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] dark:text-[#DFD0B8] text-sm focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition block">
                    @error('caption')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- الصورة الحالية -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]">الصورة
                        الحالية</label>
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="الصورة الحالية"
                        class="w-32 h-32 object-cover rounded-xl shadow-md border-2 border-[#7AAACE] mb-4">
                </div>

                <!-- تحديث الصورة -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]"
                        for="image">تحديث الصورة (اختياري)</label>
                    <input
                        class="block w-full text-sm text-[#355872] dark:text-[#DFD0B8] border border-[#9CD5FF] dark:border-[#948979] rounded-xl cursor-pointer bg-[#F7F8F0] dark:bg-[#393E46] focus:outline-none file:bg-[#9CD5FF] dark:file:bg-[#948979] file:text-[#355872] dark:file:text-[#DFD0B8] file:border-0 file:py-3 file:px-6 file:mr-4 file:rounded-lg hover:file:bg-[#7AAACE] dark:hover:file:bg-[#DFD0B8] transition"
                        id="image" type="file" name="image">
                    @error('image')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- أزرار التحكم -->
                <div class="flex justify-end gap-4 pt-4 border-t border-[#9CD5FF] dark:border-[#948979]">
                    <a href="{{ route('galleries.index') }}"
                        class="px-6 py-3 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-xl font-medium hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] transition shadow-md">
                        إلغاء
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-xl font-medium transition shadow-md hover:shadow-lg transform hover:scale-[1.02]">
                        تحديث الصورة
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-main-layout>
