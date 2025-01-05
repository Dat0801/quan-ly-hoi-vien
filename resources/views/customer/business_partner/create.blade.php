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
                Thêm đối tác</h1>

            <form action="{{ route('business_partner.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Ô 1: Thông tin cơ bản -->
                    <div class="col-lg-6">
                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            1. Thông tin cơ bản</h3>
                        <div class="border" style="border-radius: 10px; padding: 20px;">
                            <!-- Mã đăng nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="login_code" class="form-label mb-0 me-2" style="width: 250px;">Mã đăng nhập
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="login_code" name="login_code" value="{{ old('login_code') }}"
                                    placeholder="Nhập mã đăng nhập"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('login_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('login_code') }}</span>
                                @endif
                            </div>

                            <!-- Mã thẻ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="card_code" class="form-label mb-0 me-2" style="width: 250px;">Mã thẻ <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="card_code" name="card_code" value="{{ old('card_code') }}"
                                    placeholder="Nhập mã thẻ"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('card_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('card_code') }}</span>
                                @endif
                            </div>

                            <!-- Tên doanh nghiệp (Tiếng Việt) -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="business_name_vi" class="form-label mb-0 me-2" style="width: 250px;">Tên doanh nghiệp
                                    (Tiếng Việt) <span class="text-danger">*</span></label>
                                <input type="text" id="business_name_vi" name="business_name_vi"
                                    value="{{ old('business_name_vi') }}" placeholder="Nhập tên tiếng Việt"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('business_name_vi'))
                                    <span class="text-danger ms-2">{{ $errors->first('business_name_vi') }}</span>
                                @endif
                            </div>

                            <!-- Tên doanh nghiệp (Tiếng Anh) -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="business_name_en" class="form-label mb-0 me-2" style="width: 250px;">Tên doanh nghiệp
                                    (Tiếng Anh)</label>
                                <input type="text" id="business_name_en" name="business_name_en"
                                    value="{{ old('business_name_en') }}" placeholder="Nhập tên tiếng Anh (nếu có)"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('business_name_en'))
                                    <span class="text-danger ms-2">{{ $errors->first('business_name_en') }}</span>
                                @endif
                            </div>

                            <!-- Tên viết tắt -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="business_name_abbr" class="form-label mb-0 me-2" style="width: 250px;">Tên doanh nghiệp
                                    (Tên viết tắt)</label>
                                <input type="text" id="business_name_abbr" name="business_name_abbr"
                                    value="{{ old('business_name_abbr') }}" placeholder="Nhập tên viết tắt (nếu có)"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('business_name_abbr'))
                                    <span class="text-danger ms-2">{{ $errors->first('business_name_abbr') }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-1" style="width: 180px;">Phân loại <span
                                        class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="partner_category"
                                        id="category_vietnam" value="Việt Nam" required
                                        {{ old('partner_category') == 'Việt Nam' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category_vietnam">Việt Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="partner_category"
                                        id="category_international" value="Quốc tế" required
                                        {{ old('partner_category') == 'Quốc tế' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category_international">Quốc tế</label>
                                </div>
                            </div>

                            <!-- Địa chỉ trụ sở chính -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="headquarters_address" class="form-label mb-0 me-2" style="width: 250px;">Địa
                                    chỉ trụ sở chính <span class="text-danger">*</span></label>
                                <input type="text" id="headquarters_address" name="headquarters_address"
                                    value="{{ old('headquarters_address') }}" placeholder="Nhập địa chỉ trụ sở chính"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('headquarters_address'))
                                    <span class="text-danger ms-2">{{ $errors->first('headquarters_address') }}</span>
                                @endif
                            </div>

                            <!-- Địa chỉ văn phòng giao dịch -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="branch_address" class="form-label mb-0 me-2" style="width: 250px;">Địa
                                    chỉ văn phòng giao dịch</label>
                                <input type="text" id="branch_address" name="branch_address"
                                    value="{{ old('branch_address') }}"
                                    placeholder="Nhập địa chỉ văn phòng giao dịch"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('branch_address'))
                                    <span class="text-danger ms-2">{{ $errors->first('branch_address') }}</span>
                                @endif
                            </div>

                            <!-- Mã số thuế -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="tax_code" class="form-label mb-0 me-2" style="width: 250px;">Mã số
                                    thuế</label>
                                <input type="text" id="tax_code" name="tax_code" value="{{ old('tax_code') }}"
                                    placeholder="Nhập mã số thuế"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('tax_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('tax_code') }}</span>
                                @endif
                            </div>

                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện
                                    thoại <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="Nhập số điện thoại"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('phone'))
                                    <span class="text-danger ms-2">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <!-- Website -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="website" class="form-label mb-0 me-2"
                                    style="width: 250px;">Website</label>
                                <input type="text" id="website" name="website" value="{{ old('website') }}"
                                    placeholder="Nhập website (nếu có)"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('website'))
                                    <span class="text-danger ms-2">{{ $errors->first('website') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            2. Lãnh đạo đơn vị</h3>
                        <!-- Lãnh đạo đơn vị -->
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <div>
                                <!-- Họ và tên -->
                                <div class="d-flex align-items-center mb-3">
                                    <label for="leader_name" class="form-label mb-0 me-2" style="width: 250px;">Họ và
                                        tên <span class="text-danger">*</span></label>
                                    <input type="text" id="leader_name" name="leader_name"
                                        class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required placeholder="Nhập họ và tên" value="{{ old('leader_name') }}">
                                </div>

                                <!-- Chức vụ -->
                                <div class="d-flex align-items-center mb-3">
                                    <label for="leader_position" class="form-label mb-0 me-2"
                                        style="width: 250px;">Chức vụ <span class="text-danger">*</span></label>
                                    <input type="text" id="leader_position" name="leader_position"
                                        class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required placeholder="Nhập chức vụ" value="{{ old('leader_position') }}">
                                </div>

                                <!-- Số điện thoại -->
                                <div class="d-flex align-items-center mb-3">
                                    <label for="leader_phone" class="form-label mb-0 me-2" style="width: 250px;">Số
                                        điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" id="leader_phone" name="leader_phone"
                                        class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required placeholder="Nhập số điện thoại" value="{{ old('leader_phone') }}">
                                </div>

                                <!-- Giới tính -->
                                <div class="d-flex align-items-center mb-3">
                                    <label class="form-label mb-0 me-1" style="width: 180px;">Giới tính <span
                                            class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="leader_gender"
                                            id="gender_male" value="male" required
                                            {{ old('leader_gender') == 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_male">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="leader_gender"
                                            id="gender_female" value="female" required
                                            {{ old('leader_gender') == 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_female">Nữ</label>
                                    </div>
                                </div>

                                <!-- Email liên hệ trực tiếp -->
                                <div class="d-flex align-items-center">
                                    <label for="leader_email" class="form-label mb-0 me-2"
                                        style="width: 250px;">Email liên hệ trực tiếp <span
                                            class="text-danger">*</span></label>
                                    <input type="email" id="leader_email" name="leader_email"
                                        class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required placeholder="Nhập email liên hệ" value="{{ old('leader_email') }}">
                                </div>
                            </div>
                        </div>

                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            3. Phụ trách kết nối</h3>
                        <!-- Thông tin phụ trách -->
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <div id="responsible_people">
                                <div class="d-flex align-items-center mb-3">
                                    <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Họ
                                        và tên <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="responsible_name[]"
                                        class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required placeholder="Nhập họ và tên"
                                        value="{{ old('responsible_name.0') }}">
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức
                                        vụ <span class="text-danger">*</span></label>
                                    <input type="text" id="position" name="responsible_position[]"
                                        class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required placeholder="Nhập chức vụ"
                                        value="{{ old('responsible_position.0') }}">
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số
                                        điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" id="phone" name="responsible_phone[]"
                                        class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required placeholder="Nhập số điện thoại"
                                        value="{{ old('responsible_phone.0') }}">
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <label class="form-label mb-0 me-1" style="width: 180px;">Giới tính <span
                                            class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="responsible_gender[0]"
                                            id="gender_male" value="male" required
                                            {{ old('responsible_gender.0') == 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_male">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="responsible_gender[0]"
                                            id="gender_female" value="female" required
                                            {{ old('responsible_gender.0') == 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_female">Nữ</label>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email
                                        liên hệ trực tiếp <span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="responsible_email[]"
                                        class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required placeholder="Nhập email liên hệ"
                                        value="{{ old('responsible_email.0') }}">
                                </div>

                                <hr class="my-4" style="border: 1px solid #FF7506;">

                            </div>
                            <!-- Nút Thêm người phụ trách -->
                            <div class="d-flex justify-content-end mb-2">
                                <button type="button" class="btn btn-outline-primary"
                                    onclick="addResponsiblePerson()">Thêm người phụ trách</button>
                            </div>
                        </div>
                    </div>
                    <!-- Nút Lưu và Hủy -->
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('business_partner.index') }}"
                            class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                        <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
