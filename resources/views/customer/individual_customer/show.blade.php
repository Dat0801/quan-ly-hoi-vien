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
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    <div class="d-flex align-items-start" style="margin-right: 110px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                Thông tin khách hàng
            </h1>

            <form action="{{ route('individual_customer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <!-- Phần 1: Thông tin cá nhân -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            1. Thông tin cá nhân
                        </h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Mã đăng nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="login_code" class="form-label mb-0 me-2" style="width: 250px;">Mã đăng nhập
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="login_code" name="login_code" value="{{ $customer->login_code }}"
                                    placeholder="Nhập mã đăng nhập"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    disabled>
                                @if ($errors->has('login_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('login_code') }}</span>
                                @endif
                            </div>

                            <!-- Mã thẻ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="card_code" class="form-label mb-0 me-2" style="width: 250px;">Mã thẻ</label>
                                <input type="text" id="card_code" name="card_code" value="{{ $customer->card_code }}"
                                    placeholder="Nhập mã thẻ"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    disabled>
                                @if ($errors->has('card_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('card_code') }}</span>
                                @endif
                            </div>

                            <!-- Họ và tên -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="full_name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="full_name" name="full_name" value="{{ $customer->full_name }}"
                                    placeholder="Nhập họ và tên"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    disabled>
                                @if ($errors->has('full_name'))
                                    <span class="text-danger ms-2">{{ $errors->first('full_name') }}</span>
                                @endif
                            </div>

                            <!-- Chức vụ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ</label>
                                <input type="text" id="position" name="unit_position" value="{{ $customer->unit_position }}"
                                    placeholder="Nhập chức vụ"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    disabled>
                                @if ($errors->has('unit_position'))
                                    <span class="text-danger ms-2">{{ $errors->first('unit_position') }}</span>
                                @endif
                            </div>

                            <!-- Ngày sinh -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="dob" class="form-label mb-0 me-2" style="width: 250px;">Ngày sinh</label>
                                <input type="date" id="dob" name="birth_date" value="{{ $customer->birth_date }}"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    disabled>
                                @if ($errors->has('birth_date'))
                                    <span class="text-danger ms-2">{{ $errors->first('birth_date') }}</span>
                                @endif
                            </div>

                            <!-- Giới tính -->
                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-2" style="width: 180px;">Giới tính <span
                                        class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_male"
                                        value="male" {{ $customer->gender == 'male' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="gender_male">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_female"
                                        value="female" {{ $customer->gender == 'female' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="gender_female">Nữ</label>
                                </div>
                            </div>

                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" value="{{ $customer->phone }}"
                                    placeholder="Nhập số điện thoại" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    disabled>
                                @if ($errors->has('phone'))
                                    <span class="text-danger ms-2">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <!-- Email -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email <span
                                        class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" value="{{ $customer->email }}"
                                    placeholder="Nhập email" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    disabled>
                                @if ($errors->has('email'))
                                    <span class="text-danger ms-2">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <!-- Đơn vị -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="organization_name" class="form-label mb-0 me-2" style="width: 250px;">Đơn vị</label>
                                <input type="text" id="organization_name" name="unit_name" value="{{ $customer->unit_name }}"
                                    placeholder="Nhập tên đơn vị" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    disabled>
                                @if ($errors->has('unit_name'))
                                    <span class="text-danger ms-2">{{ $errors->first('unit_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Phần 2: Ngành và Lĩnh vực -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            2. Ngành và Lĩnh vực
                        </h3>
                        <div class="border" style="border-radius: 10px; padding: 20px;">
                            <!-- Ngành -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="industry" class="form-label mb-0 me-2" style="width: 250px;">Ngành</label>
                                <select id="industry" name="industry_id"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                                    <option value="{{ $customer->industry_id }}">
                                        {{ $customer->industry->industry_name ?? '-' }}
                                    </option>
                                </select>
                                @if ($errors->has('industry_id'))
                                    <span class="text-danger ms-2">{{ $errors->first('industry_id') }}</span>
                                @endif
                            </div>

                            <!-- Lĩnh vực -->
                            <div class="d-flex align-items-center">
                                <label for="field" class="form-label mb-0 me-2" style="width: 250px;">Lĩnh vực</label>
                                <select id="field" name="field_id"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                                    <option value="{{ $customer->field_id }}">
                                        {{ $customer->field->name ?? '-' }}
                                    </option>
                                </select>
                                @if ($errors->has('field_id'))
                                    <span class="text-danger ms-2">{{ $errors->first('field_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            3. Bán chấp hành
                        </h3>
                        <div class="border" style="border-radius: 10px; padding: 20px;">
                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-2" style="width: 180px;"></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_board_member" id="is_board_member_yes" value="1"
                                        {{ $customer->is_board_member == 1 ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="is_board_member_yes">Có</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_board_member" id="is_board_member_no" value="0"
                                        {{ $customer->is_board_member == 0 ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="is_board_member_no">Không</label>
                                </div>
                                @if ($errors->has('is_board_member'))
                                    <span class="text-danger ms-2">{{ $errors->first('is_board_member') }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label for="title" class="form-label mb-0 me-2" style="width: 250px;">Chức danh
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="board_position" value="{{ $customer->board_position }}"
                                    placeholder="Nhập chức danh"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                                @if ($errors->has('board_position'))
                                    <span class="text-danger ms-2">{{ $errors->first('board_position') }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center">
                                <label for="term" class="form-label mb-0 me-2" style="width: 250px;">Nhiệm kỳ
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="term" name="term" value="{{ $customer->term }}"
                                    placeholder="Nhập nhiệm kỳ"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
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

                            <div class="d-flex align-items-center">
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
                    <a href="{{ route('individual_customer.index') }}"
                        class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Đóng</a>
                    <a href="{{ route('individual_customer.edit', $customer->id) }}"
                        class="btn btn-primary w-48 py-3 sm:rounded-lg">Chỉnh sửa</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
