<x-main-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div
            class="bg-[#F7F8F0] dark:bg-[#393E46] rounded-3xl shadow-xl border border-[#9CD5FF] dark:border-[#948979] p-8">

            <h2 class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8] mb-6">إنشاء رمز دعوة لمشرف جديد</h2>

            <!-- رسالة النجاح -->
            @if (session('success'))
                <div
                    class="bg-[#7AAACE]/20 border border-[#7AAACE] text-[#355872] dark:text-[#DFD0B8] px-4 py-3 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.invitation-codes.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- الرمز -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-[#948979]">رمز الدعوة <span
                                class="text-red-500">*</span></label>
                        <div class="flex gap-2">
                            <input type="text" id="codeInput" name="code" value="{{ strtoupper(Str::random(6)) }}"
                                class="flex-1 px-4 py-3 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] focus:ring-2 focus:ring-[#7AAACE] outline-none uppercase font-bold tracking-wider"
                                required>
                            <button type="button" onclick="generateCode()"
                                class="px-4 py-2 bg-[#9CD5FF] hover:bg-[#7AAACE] text-[#355872] rounded-xl transition">
                                🎲
                            </button>
                        </div>
                    </div>

                    <!-- الكلية -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-[#948979]">الكلية (اختياري)</label>
                        <select name="faculty_id"
                            class="w-full px-4 py-3 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] focus:ring-2 focus:ring-[#7AAACE] outline-none">
                            <option value="">جميع الكليات</option>
                            @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- عدد الاستخدامات -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-[#948979]">عدد الاستخدامات المسموحة</label>
                        <input type="number" name="max_uses" value="1" min="1" max="100"
                            class="w-full px-4 py-3 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] focus:ring-2 focus:ring-[#7AAACE] outline-none">
                    </div>

                    <!-- تاريخ الانتهاء -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-[#948979]">تاريخ الانتهاء (اختياري)</label>
                        <input type="date" name="expires_at"
                            class="w-full px-4 py-3 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#393E46] text-[#355872] focus:ring-2 focus:ring-[#7AAACE] outline-none">
                    </div>
                </div>

                <button type="submit"
                    class="mt-8 w-full py-4 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition transform hover:scale-[1.02]">
                    إنشاء الرمز
                </button>
            </form>
        </div>
    </div>

    <script>
        function generateCode() {
            const length = 6;
            const charset = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
            let result = "";
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                result += charset[randomIndex];
            }
            document.getElementById("codeInput").value = result;
        }
    </script>
</x-main-layout>
