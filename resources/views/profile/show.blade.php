<x-app-layout :hideSidebar="true">
    <div class="d-flex align-items-start" style="margin-left: 2%;">
        <div class="p-4 bg-white shadow-sm rounded-lg d-flex">
            <!-- Left div with profile picture and information -->
            <div class="flex-shrink-0 w-25 p-4 text-center">
                <div class="position-relative w-100">
                    <!-- Circle image -->
                    <img src="{{ asset('/images/avt.png') }}" alt="Profile Picture" class="rounded-circle" 
                    style="width: 265px; height: 265px; object-fit: cover; margin: 0 auto;">
                    
                    <!-- Change picture button -->
                    <button class="position-absolute bottom-0 end-0 btn btn-warning rounded-circle" style="transform: translate(-200%, 0%); width: 45px; height: 45px;">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
        
                <!-- Username under image -->
                <div class="mt-3">
                    <span class="h5" style="color: #803B03">{{ $user->name }}</span>
                </div>
            </div>
        
            <!-- Right div with form inputs -->
            <div class="flex-grow-1 p-4">
                <div class="row">
                    <!-- User Name Input -->
                    <div class="col-md-6 mb-3">
                        <label for="fullname" class="form-label">Tên người dùng</label>
                        <input type="text" id="fullname" name="fullname" value="{{ $user->name }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                    </div>
        
                    <!-- Username Input -->
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" value="{{ $user->email }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                    </div>
        
                    <!-- Phone Number Input -->
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" value="{{ $user->phone_number }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                    </div>
        
                    <!-- Password Input -->
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <div class="position-relative">
                            <input type="password" id="password" name="password" value="{{ $user->password }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                            <button type="button" id="togglePassword" class="position-absolute ranslate-middle-y text-muted" style="right: 10px; top: 10px;">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
        
                    <!-- Email Input -->
                    <div class="col-md-12 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                    </div>
        
                    <!-- Role Input -->
                    <div class="col-md-12 mb-3">
                        <label for="role" class="form-label">Vai trò</label>
                        <input type="text" id="role" name="role" value="{{ $user->role->role_name }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" disabled>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right buttons container -->
        <div class="d-flex flex-column justify-content-between ms-4 bg-white sm:rounded-lg">
            <!-- Edit Button with smaller size -->
            <a href="{{ route('profile.edit') }}" class="btn btn-white d-flex flex-column align-items-center justify-content-center border-0 py-3" 
                style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;">
                <i class="fas fa-edit fa-lg mt-2" style="color: #FF7506;"></i>
                <span class="mt-3" style="color: #FF7506; font-size: 12px; word-wrap: break-word;">Chỉnh sửa</span>
            </a>
            <!-- Divider (Horizontal line) -->
            <div class="border-bottom mb-2" style="border-color: #FF7506;"></div>

            <!-- Logout Button with smaller size -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-white w-100 d-flex flex-column align-items-center justify-content-center border-0 py-3 sm:rounded-lg"
                    style="color: #FF7506; border-color: #FF7506; width: 80px; text-align: center;">
                    <i class="fas fa-sign-out-alt fa-lg text-danger"></i>
                    <span class="text-danger mt-3" style="font-size: 12px; word-wrap: break-word;">Đăng xuất</span>
                </button>
            </form>
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
        // Remove any non-digit characters
        const cleanNumber = phoneNumber.replace(/\D/g, '');

        // Ensure the number starts with the +84 prefix, only add it if not already there
        if (cleanNumber.startsWith('84')) {
            phoneNumber = `+${cleanNumber}`;
        } else {
            phoneNumber = `+84 ${cleanNumber.slice(1)}`;
        }

        // Add +84 as the prefix
        let formatted = '+84 ';
        
        // Process the rest of the digits in chunks of 3
        const restOfNumber = cleanNumber.slice(2);  // Skip the '84' prefix
        for (let i = 0; i < restOfNumber.length; i += 3) {
            formatted += restOfNumber.substring(i, i + 3) + ' ';
        }

        // Trim any trailing spaces and return the formatted number
        return formatted.trim();
    }

    // Function to clean phone number (remove spaces and non-digit characters)
    function cleanPhoneNumber(phoneNumber) {
        return phoneNumber.replace(/\D/g, ''); // Remove all non-digit characters
    }

    // Function to update the phone number input with formatted display value
    function updatePhoneNumberDisplay() {
        const phoneInput = document.getElementById('phone');
        const formattedPhone = formatPhoneNumberForDisplay(phoneInput.value);
        
        // Set the formatted value back to the input field
        phoneInput.value = formattedPhone;
    }

    // Event listener to update the phone number when the input changes
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', updatePhoneNumberDisplay);

    // Initial formatting on page load if needed
    updatePhoneNumberDisplay();

    // Example on form submit to clean the phone number before storing in the database
    const form = document.querySelector('form');  // Your form selector here
    form.addEventListener('submit', function (e) {
        const phoneInput = document.getElementById('phone');
        // Clean the phone number to save to database
        const cleanedPhone = cleanPhoneNumber(phoneInput.value);
        phoneInput.value = cleanedPhone;  // Update the phone input value before submitting
        
        // Now, the cleaned phone number will be submitted (without spaces and non-numeric characters)
    });

</script>