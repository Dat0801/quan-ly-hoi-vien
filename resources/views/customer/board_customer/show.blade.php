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
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">Chi tiết ban chấp hành</h1>

            <form action="{{ route('board_customer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Phần 1: Thông tin cá nhân -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">1. Thông tin cá nhân</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Mã đăng nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="login_code" class="form-label mb-0 me-2" style="width: 250px;">Mã đăng nhập <span class="text-danger">*</span></label>
                                <input type="text" id="login_code" name="login_code" value="{{ old('login_code', $customer->login_code) }}" placeholder="Nhập mã đăng nhập" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" {{ isset($customer) ? 'disabled' : '' }} required>
                                @if ($errors->has('login_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('login_code') }}</span>
                                @endif
                            </div>

                            <!-- Mã thẻ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="card_code" class="form-label mb-0 me-2" style="width: 250px;">Mã thẻ</label>
                                <input type="text" id="card_code" name="card_code" value="{{ old('card_code', $customer->card_code) }}" placeholder="Nhập mã thẻ" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" {{ isset($customer) ? 'disabled' : '' }}>
                                @if ($errors->has('card_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('card_code') }}</span>
                                @endif
                            </div>

                            <!-- Họ và tên -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="full_name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $customer->full_name) }}" placeholder="Nhập họ và tên" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" {{ isset($customer) ? 'disabled' : '' }} required>
                                @if ($errors->has('full_name'))
                                    <span class="text-danger ms-2">{{ $errors->first('full_name') }}</span>
                                @endif
                            </div>

                            <!-- Ngày sinh -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="dob" class="form-label mb-0 me-2" style="width: 250px;">Ngày sinh</label>
                                <input type="date" id="dob" name="birth_date" value="{{ old('birth_date', $customer->birth_date) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" {{ isset($customer) ? 'disabled' : '' }}>
                                @if ($errors->has('birth_date'))
                                    <span class="text-danger ms-2">{{ $errors->first('birth_date') }}</span>
                                @endif
                            </div>

                            <!-- Giới tính -->
                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-2" style="width: 180px;">Giới tính</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" {{ old('gender', $customer->gender) == 'male' ? 'checked' : '' }} {{ isset($customer) ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="gender_male">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" {{ old('gender', $customer->gender) == 'female' ? 'checked' : '' }} {{ isset($customer) ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="gender_female">Nữ</label>
                                </div>
                            </div>

                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" placeholder="Nhập số điện thoại" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" {{ isset($customer) ? 'disabled' : '' }}>
                                @if ($errors->has('phone'))
                                    <span class="text-danger ms-2">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <!-- Email -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}" placeholder="Nhập email" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" {{ isset($customer) ? 'disabled' : '' }}>
                                @if ($errors->has('email'))
                                    <span class="text-danger ms-2">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <!-- Ảnh đại diện -->
                            <div class="d-flex align-items-center">
                                <label class="form-label mb-0 me-2" style="width: 180px;">Ảnh đại diện</label>
                                <div class="avatar-upload-box position-relative" style="width: 120px; height: 120px;">
                                    <div class="avatar-preview position-absolute top-0 left-0 w-100 h-100 d-flex justify-content-center align-items-center rounded-3" style="background-color: #f0f0f0;">
                                        <img class="img-fluid w-100 h-100 object-fit-cover rounded-3" 
                                                src="{{ isset($customer) && $customer->avatar ? asset('storage/' . $customer->avatar) : '' }}" 
                                                alt="Avatar" id="avatar-image" 
                                                style="z-index: 1; {{ isset($customer) && $customer->avatar ? '' : 'display: none;' }}" />
                                    </div>
                                </div>

                                @if ($errors->has('avatar'))
                                    <span class="text-danger ms-2">{{ $errors->first('avatar') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Phần 2: Thông tin đơn vị -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">2. Thông tin đơn vị</h3>
                        <div class="border" style="border-radius: 10px; padding: 20px;">
                            <!-- Tên đơn vị -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="organization_name" class="form-label mb-0 me-2" style="width: 250px;">Tên đơn vị</label>
                                <input type="text" id="organization_name" name="unit_name" value="{{ old('unit_name', $customer->unit_name) }}" placeholder="Nhập tên đơn vị" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" {{ isset($customer) ? 'disabled' : '' }}>
                                @if ($errors->has('unit_name'))
                                    <span class="text-danger ms-2">{{ $errors->first('unit_name') }}</span>
                                @endif
                            </div>

                            <!-- Loại hình đơn vị -->
                            <div class="d-flex align-items-center">
                                <label for="organization_type" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ</label>
                                <input type="text" id="organization_type" name="unit_position" value="{{ old('unit_position', $customer->unit_position) }}" placeholder="Nhập loại hình đơn vị" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" {{ isset($customer) ? 'disabled' : '' }}>
                                @if ($errors->has('unit_type'))
                                    <span class="text-danger ms-2">{{ $errors->first('unit_type') }}</span>
                                @endif
                            </div>
                        </div>

                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">3. Chức vụ hội</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Chức danh -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="title" class="form-label mb-0 me-2" style="width: 250px;">Chức danh</label>
                                <input type="text" id="title" name="association_position" value="{{ old('association_position', $customer->association_position) }}" placeholder="Nhập chức danh" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                                @if ($errors->has('association_position'))
                                    <span class="text-danger ms-2">{{ $errors->first('association_position') }}</span>
                                @endif
                            </div>

                            <!-- Nhiệm kỳ -->
                            <div class="d-flex align-items-center">
                                <label for="term" class="form-label mb-0 me-2" style="width: 250px;">Nhiệm kỳ</label>
                                <input type="text" id="term" name="term" value="{{ old('term', $customer->term) }}" placeholder="Nhập nhiệm kỳ" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                                @if ($errors->has('term'))
                                    <span class="text-danger ms-2">{{ $errors->first('term') }}</span>
                                @endif
                            </div>
                        </div>

                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">4. Thông tin tài khoản</h3>
                        <div class="border" style="border-radius: 10px; padding: 20px;">
                            <div class="d-flex align-items-center mb-3">
                                <label for="activity_status" class="form-label mb-0 me-2" style="width: 250px;">Thông tin đăng nhập</label>
                                <input type="text" id="activity_status" name="activity_status" value="{{ old('activity_status', $customer->login_code) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" {{ isset($customer) ? 'disabled' : '' }}>
                                @if ($errors->has('activity_status'))
                                    <span class="text-danger ms-2">{{ $errors->first('activity_status') }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label for="activity_status" class="form-label mb-0 me-2" style="width: 180px;">Tình trạng hoạt động</label>
                                <span class="badge {{ $customer->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $customer->status ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
                                </span>
                                @if ($errors->has('activity_status'))
                                    <span class="text-danger ms-2">{{ $errors->first('activity_status') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <x-cancel-button :route="route('board_customer.index')">
                        Đóng
                    </x-cancel-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
