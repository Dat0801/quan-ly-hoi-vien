<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-text-input id="email" class="block mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
            placeholder="Tên đăng nhập"
            value="nguyenbin394@gmail.com"
            />
        </div>

        <!-- Password -->
        <div class="relative mt-1">
            <x-text-input id="password" class="block mt-1 pr-10"
                          type="password"
                          name="password"
                          required autocomplete="current-password" 
                          placeholder="Mật khẩu"
                          value="password"
            />
            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-3 py-2 text-sm text-gray-500">
                <i id="eyeIcon" class="fas fa-eye-slash"></i> 
            </button>
            <x-input-error :messages="$errors->get('email') + $errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-2">
            <div class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Ghi nhớ mật khẩu</span>
            </div>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                href="{{ route('password.request') }}"
                style="color: #BF5805"
                >
                    Quên mật khẩu?
                </a>
            @endif
        </div>

        <div class="mt-4">
            <x-primary-button :width="540" :height="48">
                Đăng nhập
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye'); 
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    });
</script>
