<x-app-layout :hideSidebar="true">
    <div class="d-flex align-items-start">
        <div class="p-4 bg-white shadow-sm rounded-lg d-flex">
            <div class="flex-shrink-0 w-25 p-4 text-center">
                <div class="position-relative w-100">
                    <img src="{{ Auth::check() && Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : '/images/avt.png' }}"
                        alt="Profile Picture" class="rounded-circle" 
                        style="width: 265px; height: 265px; object-fit: cover; margin: 0 auto;">
                    
                    <button class="position-absolute bottom-0 start-50 btn btn-warning rounded-circle" 
                        style="transform: translateX(-50%); width: 45px; height: 45px;">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
        
                <div class="mt-3">
                    <span class="h5" style="color: #803B03">{{ $user->name }}</span>
                </div>
            </div>
        
            <div class="flex-grow-1 p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fullname" class="form-label">Tên người dùng</label>
                        <input type="text" id="fullname" name="fullname" value="{{ $user->name }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                    </div>
        
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" value="{{ $user->email }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                    </div>
        
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" value="{{ $user->phone_number }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                    </div>
        
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <div class="position-relative">
                            <input type="password" id="password" name="password" value="{{ $user->password }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                            <button type="button" id="togglePassword" class="position-absolute ranslate-middle-y text-muted" style="right: 10px; top: 10px;">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
        
                    <div class="col-md-12 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                    </div>
        
                    <div class="col-md-12 mb-3">
                        <label for="role" class="form-label">Vai trò</label>
                        <input type="text" id="role" name="role" value="{{ $user->role->role_name }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg">
            <a href="{{ route('profile.edit') }}" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 py-3" 
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;">
                <i class="fas fa-edit fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Chỉnh sửa</span>
            </a>

            <div class="border-bottom mb-2" style="border-color: #FF7506;"></div>

            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf
                <button type="button" class="btn btn-white w-100 d-flex flex-column align-items-center justify-content-center border-0 py-3 sm:rounded-lg"
                    style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;" 
                    onclick="showModal('Bạn có chắc chắn muốn đăng xuất khỏi hệ thống?', function() { submitLogoutForm(); }, function() { })">
                    <i class="fas fa-sign-out-alt fa-lg text-danger"></i>
                    <span class="text-danger mt-3" style="font-size: 12px; word-wrap: break-word;">Đăng xuất</span>
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const passwordIcon = document.querySelector('#togglePassword i');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        } else {
            passwordField.type = 'password';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        }
    });

    function formatPhoneNumberForDisplay(phoneNumber) {
        const cleanNumber = phoneNumber.replace(/\D/g, '');

        if (cleanNumber.startsWith('84')) {
            phoneNumber = `+${cleanNumber}`;
        } else {
            phoneNumber = `+84 ${cleanNumber.slice(1)}`;
        }

        let formatted = '+84 ';
        
        const restOfNumber = cleanNumber.slice(2); 
        for (let i = 0; i < restOfNumber.length; i += 3) {
            formatted += restOfNumber.substring(i, i + 3) + ' ';
        }

        return formatted.trim();
    }

    function cleanPhoneNumber(phoneNumber) {
        return phoneNumber.replace(/\D/g, ''); 
    }

    function updatePhoneNumberDisplay() {
        const phoneInput = document.getElementById('phone');
        const formattedPhone = formatPhoneNumberForDisplay(phoneInput.value);
        
        phoneInput.value = formattedPhone;
    }

    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', updatePhoneNumberDisplay);

    updatePhoneNumberDisplay();

    const form = document.querySelector('form');  
    form.addEventListener('submit', function (e) {
        const phoneInput = document.getElementById('phone');
        const cleanedPhone = cleanPhoneNumber(phoneInput.value);
        phoneInput.value = cleanedPhone;  
    });

</script>