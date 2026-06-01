<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-form-label for="email" :value="__('Email')" />
            <x-form-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
            <x-form-error name="email" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-form-button>
                {{ __('Email Password Reset Link') }}
            </x-form-button>
        </div>
    </form>
</x-guest-layout>
