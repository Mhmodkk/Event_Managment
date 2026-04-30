<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center py-8 px-4 bg-gradient-to-br from-[#F7F8F0] to-[#E8F1F5] dark:from-[#222831] dark:to-[#2C313A]">
        <div class="w-full max-w-md">

            <!-- Header -->
            <div class="text-center mb-6">
                <img src="{{ asset('logos/HPU.png') }}" class="h-14 mx-auto mb-3" alt="شعار الجامعة">
                <h2 class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">تسجيل الحضور</h2>
                <p class="text-sm text-[#948979] mt-1">{{ $event->faculty->name ?? 'جامعة الحواش' }}</p>
            </div>

            <!-- Event Info Card -->
            <div
                class="bg-white/90 dark:bg-[#393E46]/90 backdrop-blur rounded-3xl p-6 shadow-xl border border-[#9CD5FF]/50 mb-6">
                <h3 class="font-bold text-lg text-[#355872] dark:text-[#DFD0B8] mb-3">{{ $event->title }}</h3>
                <div class="space-y-2.5 text-sm text-[#948979] dark:text-[#948979]">
                    <div class="flex items-center gap-2.5">
                        <span class="text-lg">📍</span>
                        <span>{{ $event->location ?? 'غير محدد' }}</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="text-lg">🕐</span>
                        <span>{{ $event->start_date->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            {{-- ✅ عرض الحالات بشكل حصري ونظيف --}}
            @if (isset($error))
                <div
                    class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-4 rounded-xl mb-6 text-center font-medium shadow-sm">
                    ⚠️ {{ $error }}
                </div>
            @elseif (isset($alreadyAttended) && $alreadyAttended)
                <div
                    class="bg-[#7AAACE]/20 dark:bg-[#7AAACE]/10 border border-[#7AAACE]/50 text-[#355872] dark:text-[#DFD0B8] px-4 py-4 rounded-xl mb-6 text-center font-medium shadow-sm">
                    ✅ تم تسجيل حضورك بنجاح
                    @if (auth()->check())
                        <span class="block text-sm font-normal mt-1 opacity-80">كـ: {{ auth()->user()->name }}</span>
                    @endif
                </div>
            @elseif (session('success'))
                <div
                    class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-4 rounded-xl mb-6 text-center font-medium shadow-sm">
                    ✅ {{ session('success') }}
                </div>
            @else
                {{-- ✅ نموذج الزوار --}}
                @guest
                    <form method="POST"
                        action="{{ route('events.attendance.public.register', ['token' => $event->attendance_token]) }}"
                        class="bg-white/90 dark:bg-[#393E46]/90 backdrop-blur rounded-3xl p-6 shadow-xl border border-[#9CD5FF]/50 space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-[#948979] mb-1.5">الاسم الكامل <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <span
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-[#948979]">👤</span>
                                <input type="text" name="name" required autofocus
                                    class="w-full pr-11 pl-4 py-3 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#948979] mb-1.5">الرقم الجامعي (اختياري)</label>
                            <div class="relative">
                                <span
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-[#948979]">🎓</span>
                                <input type="text" name="student_id"
                                    class="w-full pr-11 pl-4 py-3 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all"
                                    placeholder="مثال: 202310555">
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full py-3.5 bg-gradient-to-r from-[#7AAACE] to-[#355872] hover:from-[#9CD5FF] hover:to-[#7AAACE] text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0">
                            تأكيد الحضور
                        </button>
                    </form>
                @endguest
            @endif

            <!-- Footer -->
            <p class="text-center text-xs text-[#948979] mt-6 opacity-75">
                🔒 هذه الصفحة متاحة فقط عبر مسح رمز الحضور الخاص بالفعالية
            </p>
        </div>
    </div>
</x-guest-layout>
