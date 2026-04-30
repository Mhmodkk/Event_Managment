<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center py-12 px-4 bg-gradient-to-br from-[#F7F8F0] to-[#E8F1F5] dark:from-[#222831] dark:to-[#2C313A]">
        <div class="w-full max-w-md">
            <!-- Header -->
            <div class="text-center mb-8">
                <img src="{{ asset('logos/HPU.png') }}" class="h-16 mx-auto mb-4">
                <h2 class="text-2xl font-bold text-[#355872] dark:text-[#DFD0B8]">تسجيل مشرف جديد</h2>
                <p class="text-sm text-[#948979] mt-2">أدخل رمز الدعوة المخصص لك</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.register.store') }}"
                class="bg-white/90 dark:bg-[#393E46]/90 backdrop-blur rounded-3xl p-8 shadow-xl border border-[#9CD5FF]/50">
                @csrf

                <!-- رمز الدعوة -->
                <div class="mb-5">
                    <label class="block text-sm font-medium text-[#948979] mb-2">رمز الدعوة <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="invitation_code" required
                        class="w-full px-4 py-3 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] focus:ring-2 focus:ring-[#7AAACE] outline-none"
                        placeholder="مثال: CS2024">
                    @error('invitation_code')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- بقية الحقول (الاسم، البريد، كلمة المرور، الكلية) -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#948979] mb-2">الاسم الكامل</label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] focus:ring-2 focus:ring-[#7AAACE] outline-none">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-[#948979] dark:text-[#948979] mb-2">
                        كلمة المرور <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-[#948979]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                            class="w-full pr-12 pl-4 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all duration-200">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- تأكيد كلمة المرور -->
                <div>
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-[#948979] dark:text-[#948979] mb-2">
                        تأكيد كلمة المرور <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-[#948979]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            autocomplete="new-password"
                            class="w-full pr-12 pl-4 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all duration-200">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#948979] mb-2">البريد الجامعي</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] focus:ring-2 focus:ring-[#7AAACE] outline-none"
                        placeholder="admin@hpu.edu.sy">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-[#948979] mb-2">الكلية</label>
                    <select name="faculty_id" required
                        class="w-full px-4 py-3 rounded-xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] focus:ring-2 focus:ring-[#7AAACE] outline-none">
                        <option value="">اختر الكلية...</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="w-full py-3 bg-[#7AAACE] hover:bg-[#9CD5FF] text-white font-bold rounded-xl transition shadow-lg">
                    إنشاء حساب المشرف
                </button>
            </form>

            <!-- رابط العودة -->
            <p class="text-center mt-6 text-sm text-[#948979]">
                <a href="{{ route('login') }}" class="text-[#7AAACE] hover:underline">← العودة لتسجيل الدخول</a>
            </p>
        </div>
    </div>
</x-guest-layout>
