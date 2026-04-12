<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8] leading-tight">
                تعديل صورة في المعرض
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.update', $gallery) }}" enctype="multipart/form-data"
                class="p-8 bg-[#F7F8F0] dark:bg-[#393E46] rounded-2xl shadow-xl border border-[#9CD5FF] dark:border-[#948979] space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="caption" class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]">الشرح
                        / التعليق</label>
                    <input type="text" id="caption" name="caption" value="{{ old('caption', $gallery->caption) }}"
                        class="bg-[#F7F8F0] dark:bg-[#393E46] border border-[#9CD5FF] dark:border-[#948979] text-[#355872] dark:text-[#DFD0B8] text-sm rounded-lg focus:ring-[#7AAACE] focus:border-[#7AAACE] block w-full p-3.5">
                    @error('caption')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]">الصورة
                            الحالية</label>
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="الصورة الحالية"
                            class="w-32 h-32 object-cover rounded-lg shadow border border-[#9CD5FF] dark:border-[#948979]">
                    </div>

                    <label class="block mb-2 text-sm font-medium text-[#948979] dark:text-[#948979]"
                        for="image">تحديث الصورة (اختياري)</label>
                    <input
                        class="block w-full text-sm text-[#355872] dark:text-[#DFD0B8] border border-[#9CD5FF] dark:border-[#948979] rounded-lg cursor-pointer bg-[#F7F8F0] dark:bg-[#393E46] focus:outline-none file:bg-[#9CD5FF] dark:file:bg-[#948979] file:text-[#355872] dark:file:text-[#DFD0B8] file:border-0 file:py-3 file:px-5 file:mr-4 hover:file:bg-[#7AAACE] dark:hover:file:bg-[#DFD0B8]"
                        id="image" type="file" name="image">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('galleries.index') }}"
                        class="px-6 py-3 bg-[#9CD5FF] dark:bg-[#948979] text-[#355872] dark:text-[#DFD0B8] rounded-lg hover:bg-[#7AAACE] dark:hover:bg-[#DFD0B8] transition">
                        إلغاء
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                        تحديث الصورة
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
