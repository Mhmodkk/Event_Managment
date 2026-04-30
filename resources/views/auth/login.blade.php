<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-[#F7F8F0] via-[#E8F1F5] to-[#F7F8F0] dark:from-[#222831] dark:via-[#2C313A] dark:to-[#222831]">

        <!-- بطاقة تسجيل الدخول -->
        <div class="w-full max-w-md">
            <!-- الشعار والعنوان -->
            <div class="text-center mb-10">
                <a href="{{ route('welcome') }}"
                    class="inline-block mb-4 transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('logos/HPU.png') }}" alt="شعار جامعة الحواش"
                        class="h-20 w-auto object-contain mx-auto drop-shadow-lg">
                </a>
                <h2 class="text-3xl font-extrabold text-[#355872] dark:text-[#DFD0B8] tracking-tight">
                    مرحباً بعودتك 👋
                </h2>
                <p class="mt-2 text-[#948979] dark:text-[#948979] text-sm">
                    سجل دخولك للوصول إلى منصة فعاليات جامعة الحواش
                </p>
            </div>

            <!-- النموذج -->
            <div
                class="bg-white/80 dark:bg-[#393E46]/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-[#9CD5FF]/50 dark:border-[#948979]/50 p-8 lg:p-10">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- البريد الإلكتروني -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-[#948979] dark:text-[#948979] mb-2">
                            البريد الإلكتروني
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-[#948979]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" required autofocus
                                autocomplete="username" value="{{ old('email') }}"
                                class="w-full pr-12 pl-4 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all duration-200">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-500 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- كلمة المرور -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-[#948979] dark:text-[#948979] mb-2">
                            كلمة المرور
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
                                autocomplete="current-password"
                                class="w-full pr-12 pl-4 py-4 rounded-2xl border border-[#9CD5FF] dark:border-[#948979] bg-[#F7F8F0] dark:bg-[#222831] text-[#355872] dark:text-[#DFD0B8] placeholder-[#948979] focus:ring-2 focus:ring-[#7AAACE] focus:border-[#7AAACE] outline-none transition-all duration-200">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-500 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- تذكرني + نسيت كلمة المرور -->
                    <div class="flex items-center justify-between">
                        <label for="remember" class="flex items-center gap-2 cursor-pointer group">
                            <input id="remember" name="remember" type="checkbox"
                                class="w-5 h-5 rounded border-[#9CD5FF] dark:border-[#948979] text-[#7AAACE] focus:ring-[#7AAACE] bg-[#F7F8F0] dark:bg-[#222831] cursor-pointer transition">
                            <span
                                class="text-sm text-[#948979] dark:text-[#948979] group-hover:text-[#7AAACE] transition-colors">تذكرني</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-[#7AAACE] hover:text-[#9CD5FF] dark:hover:text-[#9CD5FF] transition-colors">
                                نسيت كلمة المرور؟
                            </a>
                        @endif
                    </div>

                    <!-- زر الدخول -->
                    <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-[#7AAACE] to-[#355872] hover:from-[#9CD5FF] hover:to-[#7AAACE] text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
                        تسجيل الدخول
                    </button>
                </form>

                <!-- روابط التنقل -->
                <div class="mt-8 pt-6 border-t border-[#9CD5FF]/30 dark:border-[#948979]/30">
                    <p class="text-center text-sm text-[#948979]">
                        ليس لديك حساب؟
                        <a href="{{ route('register') }}"
                            class="font-bold text-[#7AAACE] hover:text-[#9CD5FF] transition-colors">
                            إنشاء حساب جديد
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
                    للمشرفين والمديرين: استخدم بريدك الجامعي للدخول
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
