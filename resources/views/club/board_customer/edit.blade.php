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
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">Chỉnh sửa thông tin ban điều hành</h1>

            <form action="{{ route('club.board_customer.update', [$club->id, $boardCustomer->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Phần 1: Thông tin cá nhân -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">1. Thông tin cá nhân</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Mã đăng nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="login_code" class="form-label mb-0 me-2" style="width: 250px;">Mã BĐH <span class="text-danger">*</span></label>
                                <input type="text" id="login_code" name="login_code" value="{{ old('login_code', $boardCustomer->login_code) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                            </div>

                            <!-- Họ và tên -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="full_name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $boardCustomer->full_name) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                            </div>

                            <!-- Ngày sinh -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="dob" class="form-label mb-0 me-2" style="width: 250px;">Ngày sinh</label>
                                <input type="date" id="dob" name="birth_date" value="{{ old('birth_date', $boardCustomer->birth_date) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Giới tính -->
                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-2" style="width: 180px;">Giới tính</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" {{ old('gender', $boardCustomer->gender) == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender_male">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" {{ old('gender', $boardCustomer->gender) == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender_female">Nữ</label>
                                </div>
                            </div>

                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $boardCustomer->phone) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Đơn vị -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="organization_name" class="form-label mb-0 me-2" style="width: 250px;">Đơn vị</label>
                                <input type="text" id="organization_name" name="unit_name" value="{{ old('unit_name', $boardCustomer->unit_name) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Chức vụ -->
                            <div class="d-flex align-items-center">
                                <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ</label>
                                <input type="text" id="position" name="unit_position" value="{{ old('unit_position', $boardCustomer->unit_position) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>
                        </div>
                    </div>

                    <!-- Phần 2: Về câu lạc bộ -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">2. Về câu lạc bộ</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Chức danh câu lạc bộ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="title" class="form-label mb-0 me-2" style="width: 250px;">Chức danh câu lạc bộ</label>
                                <input type="text" id="title" name="association_position" value="{{ old('association_position', $boardCustomer->association_position) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Nhiệm kỳ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="term" class="form-label mb-0 me-2" style="width: 250px;">Nhiệm kỳ</label>
                                <input type="text" id="term" name="term" value="{{ old('term', $boardCustomer->term) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>
                        </div>
                    </div>

                    <!-- Nút Lưu -->
                    <div class="d-flex justify-content-center gap-3">
                        <x-cancel-button :route="route('club.board_customer.index', $club->id)">
                            Hủy
                        </x-cancel-button>
                        <x-primary-button >
                            Lưu
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
