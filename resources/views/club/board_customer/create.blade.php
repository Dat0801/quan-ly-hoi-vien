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
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">Thêm ban điều hành</h1>

            <form action="{{ route('club.board_customer.store', $club->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Phần 1: Thông tin cá nhân -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">1. Thông tin cá nhân</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Mã đăng nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="login_code" class="form-label mb-0 me-2" style="width: 250px;">Mã BĐH <span class="text-danger">*</span></label>
                                <input type="text" id="login_code" name="login_code" value="{{ old('login_code') }}" placeholder="Nhập mã ban điều hành" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('login_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('login_code') }}</span>
                                @endif
                            </div>

                            <!-- Họ và tên -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="full_name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="Nhập họ và tên" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('full_name'))
                                    <span class="text-danger ms-2">{{ $errors->first('full_name') }}</span>
                                @endif
                            </div>

                            <!-- Ngày sinh -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="dob" class="form-label mb-0 me-2" style="width: 250px;">Ngày sinh</label>
                                <input type="date" id="dob" name="birth_date" value="{{ old('birth_date') }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('birth_date'))
                                    <span class="text-danger ms-2">{{ $errors->first('birth_date') }}</span>
                                @endif
                            </div>

                            <!-- Giới tính -->
                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-2" style="width: 180px;">Giới tính</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender_male">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender_female">Nữ</label>
                                </div>
                            </div>

                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Nhập số điện thoại" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('phone'))
                                    <span class="text-danger ms-2">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label for="organization_name" class="form-label mb-0 me-2" style="width: 250px;">Đơn vị</label>
                                <input type="text" id="organization_name" name="unit_name" value="{{ old('unit_name') }}" placeholder="Nhập tên đơn vị" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('unit_name'))
                                    <span class="text-danger ms-2">{{ $errors->first('unit_name') }}</span>
                                @endif
                            </div>

                            <!-- Chức vụ -->
                            <div class="d-flex align-items-center">
                                <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ</label>
                                <input type="text" id="position" name="unit_position" value="{{ old('unit_position') }}" placeholder="Nhập chức vụ" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('unit_position'))
                                    <span class="text-danger ms-2">{{ $errors->first('unit_position') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h3 class="p-2" 
                        style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">2. Về câu lạc bộ</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <div class="d-flex align-items-center mb-3">
                                <label for="title" class="form-label mb-0 me-2" style="width: 250px;">Chức danh câu lạc bộ</label>
                                <input type="text" id="title" name="association_position" value="{{ old('association_position') }}" placeholder="Nhập chức danh" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('association_position'))
                                    <span class="text-danger ms-2">{{ $errors->first('association_position') }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label for="term" class="form-label mb-0 me-2" style="width: 250px;">Nhiệm kỳ</label>
                                <input type="text" id="term" name="term" value="{{ old('term') }}" placeholder="Nhập nhiệm kỳ" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('term'))
                                    <span class="text-danger ms-2">{{ $errors->first('term') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('club.board_customer.index', $club->id) }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                        <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>