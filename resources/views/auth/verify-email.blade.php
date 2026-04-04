<x-guest-layout>
    <div class="mb-4 text-sm" style="color: #355872; @media (prefers-color-scheme: dark) { color: #948979; }">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm"
            style="color: #7AAACE; @media (prefers-color-scheme: dark) { color: #DFD0B8; }">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button
                    style="background-color: #355872; @media (prefers-color-scheme: dark) { background-color: #DFD0B8; color: #222831; }">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2"
                style="color: #355872; focus:ring-color: #7AAACE;
                       @media (prefers-color-scheme: dark) {
                           color: #948979;
                           &:hover { color: #DFD0B8; }
                           focus:ring-color: #393E46;
                           focus:ring-offset-color: #222831;
                       }">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
