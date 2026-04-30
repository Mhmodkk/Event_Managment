<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-[#F7F8F0] via-[#E8F1F5] to-[#F7F8F0] dark:from-[#222831] dark:via-[#2C313A] dark:to-[#222831]">

        <div class="w-full max-w-2xl">
            <!-- الشعار والعنوان -->
            <div class="text-center mb-8">
                <a href="{{ route('welcome') }}"
                    class="inline-block mb-4 transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('logos/HPU.png') }}" alt="شعار جامعة الحواش"
                        class="h-16 w-auto object-contain mx-auto drop-shadow-lg">
                </a>
                <h2 class="text-3xl font-extrabold text-[#355872] dark:text-[#DFD0B8] tracking-tight">
                    انضم إلى منصتنا 🎓
                </h2>
                <p class="mt-2 text-[#948979] dark:text-[#948979] text-sm">
                    أنشئ حسابك كطالب للوصول إلى فعاليات جامعة الحواش
                </p>
            </div>

            <!-- النموذج -->
            <div
                class="bg-white/80 dark:bg-[#393E46]/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-[#9CD5FF]/50 dark:border-[#948979]/50 p-8 lg:p-10">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- الاسم الكامل -->
                        <div class="md:col-span-2">
                            <label for="name"
                                class="block text-sm font-medium text-[#948979] dark:text-[#948979] mb-2">
                                الاسم الكامل <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#948979]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input id="name" name="name" type="text" required autofocus
                                    autocomplete="name" value="{{ old('name') }}"
                                    class="w-full pr-12 pl-4 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all duration-200">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- الرقم الجامعي -->
                        <div>
                            <label for="student_id"
                                class="block text-sm font-medium text-[#948979] dark:text-[#948979] mb-2">
                                الرقم الجامعي <span class="text-red-500">*</span>
                            </label>
                            <input id="student_id" name="student_id" type="text" required
                                placeholder="مثال: 202310555" value="{{ old('student_id') }}"
                                class="w-full px-4 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all duration-200">
                            @error('student_id')
                                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- رقم الموبايل -->
                        <div>
                            <label for="phone"
                                class="block text-sm font-medium text-[#948979] dark:text-[#948979] mb-2">
                                رقم الموبايل <span class="text-red-500">*</span>
                            </label>
                            <input id="phone" name="phone" type="tel" required placeholder="09xxxxxxxx"
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all duration-200">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- البريد الجامعي -->
                        <div class="md:col-span-2">
                            <label for="email"
                                class="block text-sm font-medium text-[#948979] dark:text-[#948979] mb-2">
                                البريد الإلكتروني الجامعي <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#948979]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" required autocomplete="username"
                                    value="{{ old('email') }}"
                                    class="w-full pr-12 pl-4 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all duration-200"
                                    placeholder="student@hpu.edu.sy">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- الكلية -->
                        <div class="md:col-span-2">
                            <label for="faculty_id"
                                class="block text-sm font-medium text-[#948979] dark:text-[#948979] mb-2">
                                الكلية <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#948979]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <select id="faculty_id" name="faculty_id" required
                                    class="w-full pr-12 pl-4 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all duration-200 appearance-none cursor-pointer">
                                    <option value="" disabled selected>اختر كليتك...</option>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty->id }}"
                                            {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                                            {{ $faculty->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#948979]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            @error('faculty_id')
                                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- كلمة المرور -->
                        <div>
                            <label for="password"
                                class="block text-sm font-medium text-[#948979] dark:text-[#948979] mb-2">
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
                                <input id="password" name="password" type="password" required
                                    autocomplete="new-password"
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
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    required autocomplete="new-password"
                                    class="w-full pr-12 pl-4 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all duration-200">
                            </div>
                        </div>
                    </div>

                    <!-- زر الإنشاء -->
                    <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-[#7AAACE] to-[#355872] hover:from-[#9CD5FF] hover:to-[#7AAACE] text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] mt-4">
                        إنشاء الحساب
                    </button>
                </form>

                <!-- روابط التنقل -->
                <div class="mt-8 pt-6 border-t border-[#9CD5FF]/30 dark:border-[#948979]/30">
                    <p class="text-center text-sm text-[#948979]">
                        لديك حساب بالفعل؟
                        <a href="{{ route('login') }}"
                            class="font-bold text-[#7AAACE] hover:text-[#9CD5FF] transition-colors">
                            تسجيل الدخول
                        </a>
                    </p>
                    <p class="text-center text-xs text-[#948979] mt-4">
                        <a href="{{ route('welcome') }}" class="hover:text-[#7AAACE] transition-colors">
                            ← العودة للرئيسية
                        </a>
                    </p>
                </div>
            </div>

            <!-- ملاحظة للمشرفين -->
            <div class="mt-6 text-center">
                <p class="text-xs text-[#948979] dark:text-[#948979]">
                    ⚠️ للمشرفين والمديرين: يتم إنشاء حساباتكم من قبل إدارة المنصة
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
