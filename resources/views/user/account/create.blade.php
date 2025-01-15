<x-app-layout>
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
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;" class="mb-3">Thêm người dùng</h1>

            <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Tên đăng nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Tên đăng nhập <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger ms-2">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <!-- Tên người dùng -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger ms-2">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <!-- Mật khẩu -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="password" class="form-label mb-0 me-2" style="width: 250px;">Mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger ms-2">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <!-- Xác nhận mật khẩu -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="password_confirmation" class="form-label mb-0 me-2" style="width: 250px;">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-6">
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone_number" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="Nhập số điện thoại" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('phone_number'))
                                    <span class="text-danger ms-2">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>

                            <!-- Vai trò -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="role_id" class="form-label mb-0 me-2" style="width: 250px;">Vai trò <span class="text-danger">*</span></label>
                                <select id="role_id" name="role_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                    <option value="">Chọn vai trò</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <span class="text-danger ms-2">{{ $errors->first('role_id') }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label for="status" class="form-label mb-0 me-2" style="width: 180px;">Trạng thái</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input 
                                            type="radio" 
                                            id="status_active" 
                                            name="status" 
                                            value="1" 
                                            class="form-check-input border-gray-300 shadow-sm focus:ring-indigo-500"
                                            {{ old('status') == '1' ? 'checked' : '' }}>
                                        <label for="status_active" class="form-check-label">Hoạt động</label>
                                    </div>
                            
                                    <div class="form-check form-check-inline">
                                        <input 
                                            type="radio" 
                                            id="status_inactive" 
                                            name="status" 
                                            value="0" 
                                            class="form-check-input border-gray-300 shadow-sm focus:ring-indigo-500"
                                            {{ old('status') == '0' ? 'checked' : '' }}>
                                        <label for="status_inactive" class="form-check-label">Ngừng hoạt động</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Ảnh đại diện -->
                            <div class="d-flex align-items-center">
                                <label class="form-label mb-0 me-2" style="width: 180px;">Ảnh đại diện</label>
                                <div class="avatar-upload-box position-relative" style="width: 120px; height: 120px;">
                                    <input type="file" id="avatar" name="avatar" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1 position-absolute w-100 h-100 opacity-0" onchange="previewImage(event)">
                                    <div class="avatar-preview position-absolute top-0 left-0 w-100 h-100 d-flex justify-content-center align-items-center rounded-3" style="background-color: #f0f0f0;">
                                        <i id="avatar-icon" class="bi bi-camera" style="font-size: 50px; color: #888; cursor: pointer;" onclick="document.getElementById('avatar').click();"></i>
                                        <img id="avatar-image" class="hidden img-fluid w-100 h-100 object-fit-cover rounded-3" src="" alt="Selected Avatar" onclick="document.getElementById('avatar').click();" />
                                    </div>
                                </div>
                                @if ($errors->has('avatar'))
                                    <span class="text-danger ms-2">{{ $errors->first('avatar') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('account.index') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                    <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    function previewImage(event) {
        const file = event.target.files[0]; 
        const reader = new FileReader(); 

        reader.onload = function(e) {
            const avatarImage = document.getElementById('avatar-image'); 
            const avatarIcon = document.getElementById('avatar-icon'); 

            if (file && file.type.startsWith('image/')) {
                avatarImage.src = e.target.result;
                avatarImage.style.display = 'block'; 
                avatarIcon.style.display = 'none'; 
            } else {
                alert('Please select a valid image file'); 
            }
        };

        if (file) {
            reader.readAsDataURL(file); 
        }
    }
</script>