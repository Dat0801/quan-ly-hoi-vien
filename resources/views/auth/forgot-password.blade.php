<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Nhập thông tin email để lấy lại mật khẩu mới')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Nhập Email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-primary-button class="w-full flex justify-center items-center" style="padding: 10px 24px; background-color: #FF7506;">
                {{ __('Gửi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
