<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
        {{ __('يرجى إدخال رمز التحقق المرسل إليك.') }}
    </div>

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        <div>
            <x-input-label for="otp" :value="__('رمز التحقق')" />
            <x-text-input id="otp" class="block mt-1 w-full text-center text-2xl tracking-widest" type="text"
                name="otp" required autofocus />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full justify-center">
                {{ __('تحقق الآن') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
