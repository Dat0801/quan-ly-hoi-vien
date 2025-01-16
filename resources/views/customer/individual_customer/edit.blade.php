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
            <h1
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                Chỉnh sửa khách hàng</h1>

            <!-- Edit Form -->
            <form action="{{ route('individual_customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Add this for PUT request to update -->
                <div class="row">
                    <!-- Phần 1: Thông tin cá nhân -->
                    <div class="col-lg-6">
                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            1. Thông tin cá nhân</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Mã đăng nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="login_code" class="form-label mb-0 me-2" style="width: 250px;">Mã đăng nhập
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="login_code" name="login_code" value="{{ old('login_code', $customer->login_code) }}"
                                    placeholder="Nhập mã đăng nhập"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('login_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('login_code') }}</span>
                                @endif
                            </div>

                            <!-- Mã thẻ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="card_code" class="form-label mb-0 me-2" style="width: 250px;">Mã thẻ <span class="text-danger">*</span></label>
                                <input type="text" id="card_code" name="card_code" value="{{ old('card_code', $customer->card_code) }}"
                                    placeholder="Nhập mã thẻ" required
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('card_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('card_code') }}</span>
                                @endif
                            </div>

                            <!-- Họ và tên -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="full_name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $customer->full_name) }}"
                                    placeholder="Nhập họ và tên"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('full_name'))
                                    <span class="text-danger ms-2">{{ $errors->first('full_name') }}</span>
                                @endif
                            </div>

                            <!-- Chức vụ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ</label>
                                <input type="text" id="position" name="position"
                                    value="{{ old('position', $customer->position) }}" placeholder="Nhập chức vụ"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('position'))
                                    <span class="text-danger ms-2">{{ $errors->first('position') }}</span>
                                @endif
                            </div>

                            <!-- Ngày sinh -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="dob" class="form-label mb-0 me-2" style="width: 250px;">Ngày
                                    sinh</label>
                                <input type="date" id="dob" name="birth_date" value="{{ old('birth_date', $customer->birth_date) }}"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('birth_date'))
                                    <span class="text-danger ms-2">{{ $errors->first('birth_date') }}</span>
                                @endif
                            </div>

                            <!-- Giới tính -->
                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-2" style="width: 180px;">Giới tính <span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_male" required
                                        value="male" {{ old('gender', $customer->gender) == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender_male">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_female" required
                                        value="female" {{ old('gender', $customer->gender) == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender_female">Nữ</label>
                                </div>
                            </div>

                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện
                                    thoại <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}"
                                    placeholder="Nhập số điện thoại" required
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('phone'))
                                    <span class="text-danger ms-2">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <!-- Email -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="email" class="form-label mb-0 me-2"
                                    style="width: 250px;">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}"
                                    placeholder="Nhập email" required
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('email'))
                                    <span class="text-danger ms-2">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <!-- Đơn vị -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="organization_name" class="form-label mb-0 me-2" style="width: 250px;">Đơn
                                    vị</label>
                                <input type="text" id="organization_name" name="unit"
                                    value="{{ old('unit', $customer->unit) }}" placeholder="Nhập tên đơn vị"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('unit'))
                                    <span class="text-danger ms-2">{{ $errors->first('unit') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Phần 2: Ngành và Lĩnh vực -->
                    <div class="col-lg-6">
                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            2. Ngành và Lĩnh vực</h3>
                        <div class="border" style="border-radius: 10px; padding: 20px;">
                            <!-- Ngành -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="industry" class="form-label mb-0 me-2"
                                    style="width: 250px;">Ngành</label>
                                <select id="industry" name="industry_id"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                    <option value="">-- Chọn ngành --</option>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry->id }}"
                                            {{ old('industry_id', $customer->industry_id) == $industry->id ? 'selected' : '' }}>
                                            {{ $industry->industry_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('industry_id'))
                                    <span class="text-danger ms-2">{{ $errors->first('industry_id') }}</span>
                                @endif
                            </div>

                            <!-- Lĩnh vực -->
                            <div class="d-flex align-items-center">
                                <label for="field" class="form-label mb-0 me-2" style="width: 250px;">Lĩnh
                                    vực</label>
                                <select id="field" name="field_id"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                    <option value="">-- Chọn lĩnh vực --</option>
                                    @foreach ($fields as $field)
                                        <option value="{{ $field->id }}"
                                            {{ old('field_id', $customer->field_id) == $field->id ? 'selected' : '' }}>
                                            {{ $field->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('field_id'))
                                    <span class="text-danger ms-2">{{ $errors->first('field_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            3. Bán chấp hành</h3>
                        <div class="border" style="border-radius: 10px; padding: 20px;">
                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-2" style="width: 180px;"></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_board_member" id="is_board_member_yes" value="1" required
                                        {{ $customer->is_board_member == 1 ? 'checked' : (old('is_board_member') == '1' ? 'checked' : '') }} onclick="toggleBoardMemberFields(true)">
                                    <label class="form-check-label" for="is_board_member_yes">Có</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_board_member" id="is_board_member_no" value="0" required
                                        {{ $customer->is_board_member == 0 ? 'checked' : (old('is_board_member') == '0' ? 'checked' : '') }} onclick="toggleBoardMemberFields(false)">
                                    <label class="form-check-label" for="is_board_member_no">Không</label>
                                </div>
                                @if ($errors->has('is_board_member'))
                                    <span class="text-danger ms-2">{{ $errors->first('is_board_member') }}</span>
                                @endif
                            </div>
                        
                            <div class="d-flex align-items-center mb-3">
                                <label for="title" class="form-label mb-0 me-2" style="width: 250px;">Chức danh <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="board_position" value="{{ old('board_position', $customer->board_position) }}"
                                    placeholder="Nhập chức danh" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    {{ $customer->is_board_member == 1 || old('is_board_member') == '1' ? 'required' : '' }}>
                                @if ($errors->has('board_position'))
                                    <span class="text-danger ms-2">{{ $errors->first('board_position') }}</span>
                                @endif
                            </div>
                        
                            <div class="d-flex align-items-center">
                                <label for="term" class="form-label mb-0 me-2" style="width: 250px;">Nhiệm kỳ <span class="text-danger">*</span></label>
                                <input type="text" id="term" name="term" value="{{ old('term', $customer->term) }}" placeholder="Nhập nhiệm kỳ"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    {{ $customer->is_board_member == 1 || old('is_board_member') == '1' ? 'required' : '' }}>
                                @if ($errors->has('term'))
                                    <span class="text-danger ms-2">{{ $errors->first('term') }}</span>
                                @endif
                            </div>
                        </div>

                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            4. Thông tin tài khoản</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <div class="d-flex align-items-center mb-3">
                                <label for="activity_status" class="form-label mb-0 me-2" style="width: 250px;">Thông
                                    tin đăng nhập</label>
                                <input type="text" id="activity_status" name="activity_status"
                                    value="{{ old('activity_status', $customer->login_code) }}"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    disabled>
                                @if ($errors->has('activity_status'))
                                    <span class="text-danger ms-2">{{ $errors->first('activity_status') }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center">
                                <label for="activity_status" class="form-label mb-0 me-2" style="width: 180px;">Tình
                                    trạng hoạt động</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_active"
                                        value="1" {{ old('status', $customer->status) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_active">Đang hoạt động</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                        id="status_inactive" value="0"
                                        {{ old('status', $customer->status) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_inactive">Ngưng hoạt động</label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="text-danger ms-2">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>
                        
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('individual_customer.index') }}"
                            class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                        <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    function toggleBoardMemberFields(isBoardMember) {
        const titleInput = document.getElementById('title');
        const termInput = document.getElementById('term');
        
        if (isBoardMember) {
            // Nếu chọn "Có", yêu cầu chức danh và nhiệm kỳ
            titleInput.setAttribute('required', 'required');
            termInput.setAttribute('required', 'required');
        } else {
            // Nếu chọn "Không", không yêu cầu chức danh và nhiệm kỳ
            titleInput.removeAttribute('required');
            termInput.removeAttribute('required');
        }
    }

    // Kiểm tra giá trị ban đầu nếu có (để khi tải lại trang với giá trị old())
    const isBoardMember = {{ old('is_board_member', $customer->is_board_member) == '1' ? 'true' : 'false' }};
    toggleBoardMemberFields(isBoardMember);
</script>
