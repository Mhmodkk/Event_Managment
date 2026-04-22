<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#355872] dark:text-[#DFD0B8]">
            إضافة صورة إلى معرض الفعالية
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data"
                class="p-10 bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl shadow-xl border border-[#9CD5FF] dark:border-[#948979] space-y-8">

                @csrf

                <!-- الفعالية المرتبطة -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-[#948979]">الفعالية</label>
                    <select name="event_id" required
                        class="w-full px-5 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-white dark:bg-[#222831]">
                        <option value="">اختر الفعالية</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}"
                                {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- الشرح / التعليق -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-[#948979]">الشرح / التعليق على الصورة</label>
                    <input type="text" name="caption" value="{{ old('caption') }}"
                        class="w-full px-5 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-white dark:bg-[#222831]">
                    @error('caption')
                        <p class="mt-1 text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- رفع الصورة -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-[#948979]">الصورة</label>
                    <input type="file" name="image" accept="image/*" required
                        class="block w-full text-sm text-[#355872] border border-[#9CD5FF] dark:border-[#948979] rounded-2xl cursor-pointer bg-white dark:bg-[#222831] file:mr-4 file:py-4 file:px-6 file:rounded-2xl file:border-0 file:bg-[#7AAACE] file:text-white hover:file:bg-[#9CD5FF]">
                    @error('image')
                        <p class="mt-1 text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('galleries.index') }}"
                        class="px-8 py-4 text-[#355872] hover:bg-[#F7F8F0] rounded-2xl">إلغاء</a>
                    <button type="submit"
                        class="px-10 py-4 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white rounded-2xl font-medium">
                        إضافة الصورة
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
