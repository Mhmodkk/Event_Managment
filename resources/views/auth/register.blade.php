<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" dir="rtl">
        @csrf

        <div class="text-center mb-8">
            <a href="/">
                <img src="{{ asset('logos/HPU.png') }}" alt="HPU Logo" class="w-24 h-auto mx-auto mb-4 object-contain">
            </a>
            <h2 class="text-3xl font-bold text-[#355872] dark:text-[#DFD0B8]">إنشاء حساب جديد</h2>
            <p class="text-[#948979] dark:text-[#948979] mt-2">انضم إلى منصة فعاليات جامعة الحواش الخاصة</p>
        </div>

        <!-- الاسم -->
        <div>
            <x-input-label for="name" :value="__('الاسم الكامل')" class="text-right" />
            <x-text-input id="name" class="block mt-1 w-full text-right" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-right" />
        </div>

        <!-- الرقم الجامعي -->
        <div class="mt-4">
            <x-input-label for="student_id" :value="__('الرقم الجامعي')" class="text-right" />
            <x-text-input id="student_id" class="block mt-1 w-full text-right" type="text" name="student_id"
                :value="old('student_id')" required placeholder="مثال: 202310555" />
            <x-input-error :messages="$errors->get('student_id')" class="mt-2 text-right" />
        </div>

        <!-- رقم الموبايل (الجديد) -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('رقم الموبايل')" class="text-right" />
            <x-text-input id="phone" class="block mt-1 w-full text-right" type="tel" name="phone"
                :value="old('phone')" required placeholder="05xxxxxxxx" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-right" />
        </div>

        <!-- البريد الجامعي -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('البريد الإلكتروني الجامعي')" class="text-right" />
            <x-text-input id="email" class="block mt-1 w-full text-right" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-right" />
        </div>

        <!-- الكلية -->
        <div class="mt-4">
            <x-input-label for="faculty_id" :value="__('الكلية')" class="text-right" />
            <select id="faculty_id" name="faculty_id"
                class="block mt-1 w-full border-[#9CD5FF] dark:border-[#948979] dark:bg-[#222831] dark:text-[#DFD0B8] focus:border-[#7AAACE] focus:ring-[#7AAACE] rounded-md shadow-sm text-right">
                <option value="" disabled selected>اختر الكلية...</option>
                @foreach ($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('faculty_id')" class="mt-2 text-right" />
        </div>

        <!-- كلمة المرور -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('كلمة المرور')" class="text-right" />
            <x-text-input id="password" class="block mt-1 w-full text-right" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-right" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" class="text-right" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full text-right" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-right" />
        </div>

        <div class="flex flex-col items-center justify-end mt-8 gap-4">
            <x-primary-button class="w-full justify-center py-3 bg-[#7AAACE] hover:bg-[#355872] transition">
                إنشاء الحساب
            </x-primary-button>

            <a href="{{ route('login') }}" class="text-sm text-[#355872] dark:text-[#DFD0B8] hover:underline">
                لديك حساب بالفعل؟ تسجيل الدخول
            </a>
        </div>
    </form>
</x-guest-layout>
