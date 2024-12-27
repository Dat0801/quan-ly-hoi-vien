<x-app-layout :hideSidebar="true">
    <div style="margin-right: 110px;">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
    <div class="d-flex align-items-start" style="margin-right: 110px;">
        <div class="p-4 bg-white shadow-sm rounded-lg d-flex">
            <div class="flex-shrink-0 w-25 p-4 text-center">
                <div class="position-relative w-100">
                    <img id="profileImage" src="{{ Auth::check() && Auth::user()->avatar ? '/images/' . Auth::user()->avatar : '/images/avt.png' }}" 
                        alt="Profile Picture" class="rounded-circle" 
                        style="width: 265px; height: 265px; object-fit: cover; margin: 0 auto;">

                    <button class="position-absolute bottom-0 strat-50 btn btn-warning rounded-circle" 
                        style="transform: translate(-50%); width: 45px; height: 45px;" 
                        onclick="document.getElementById('fileInput').click();">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
    
                <div class="mt-3">
                    <span class="h5" style="color: #803B03">{{ $user->name }}</span>
                </div>
            </div>
    
            <div class="flex-grow-1 p-4">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" id="fileInput" style="display: none;" accept="image/*" onchange="previewImage(event)" name="profile_image">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullname" class="form-label">Tên người dùng</label>
                            <input type="text" id="fullname" name="name" value="{{ $user->name }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" required>
                        </div>
    
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" id="username" name="username" value="{{ $user->email }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                        </div>
            
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" id="phone" name="phone_number" value="{{ $user->phone_number }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" required>
                        </div>
            
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div class="position-relative">
                                <input type="password" id="password" name="password" value="{{ $user->password }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" required>
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
                    
                    <div class="col-md-12 d-flex justify-content-center gap-3">
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                        <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Toggle password visibility
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

    // Function to format phone number for display
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

    // Function to clean phone number (remove spaces and non-digit characters)
    function cleanPhoneNumber(phoneNumber) {
        return phoneNumber.replace(/\D/g, ''); 
    }

    // Function to update the phone number input with formatted display value
    function updatePhoneNumberDisplay() {
        const phoneInput = document.getElementById('phone');
        const formattedPhone = formatPhoneNumberForDisplay(phoneInput.value);
        
        phoneInput.value = formattedPhone;
    }

    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', updatePhoneNumberDisplay);

    updatePhoneNumberDisplay();

    // Example on form submit to clean the phone number before storing in the database
    const form = document.querySelector('form');  
    form.addEventListener('submit', function (e) {
        const phoneInput = document.getElementById('phone');
        const cleanedPhone = cleanPhoneNumber(phoneInput.value);
        phoneInput.value = cleanedPhone;  
        
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('profileImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

</script>
