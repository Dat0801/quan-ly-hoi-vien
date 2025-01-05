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
                Chỉnh sửa đối tác
            </h1>

            <form action="{{ route('business_partner.update', $businessPartner->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Ô 1: Thông tin cơ bản -->
                    <div class="col-lg-6">
                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            1. Thông tin cơ bản
                        </h3>
                        <div class="border" style="border-radius: 10px; padding: 20px;">
                            <!-- Mã đăng nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="login_code" class="form-label mb-0 me-2" style="width: 250px;">Mã đăng nhập
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="login_code" name="login_code"
                                    value="{{ old('login_code', $businessPartner->login_code ?? '-') }}"
                                    placeholder="Nhập mã đăng nhập"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Mã thẻ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="card_code" class="form-label mb-0 me-2" style="width: 250px;">Mã thẻ <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="card_code" name="card_code"
                                    value="{{ old('card_code', $businessPartner->card_code ?? '-') }}"
                                    placeholder="Nhập mã thẻ"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Tên doanh nghiệp (Tiếng Việt) -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="business_name_vi" class="form-label mb-0 me-2" style="width: 250px;">Tên
                                    doanh nghiệp (Tiếng Việt) <span class="text-danger">*</span></label>
                                <input type="text" id="business_name_vi" name="business_name_vi"
                                    value="{{ old('business_name_vi', $businessPartner->business_name_vi ?? '-') }}"
                                    placeholder="Nhập tên tiếng Việt"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Tên doanh nghiệp (Tiếng Anh) -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="business_name_en" class="form-label mb-0 me-2" style="width: 250px;">Tên
                                    doanh nghiệp (Tiếng Anh)</label>
                                <input type="text" id="business_name_en" name="business_name_en"
                                    value="{{ old('business_name_en', $businessPartner->business_name_en ?? '-') }}"
                                    placeholder="Nhập tên tiếng Anh (nếu có)"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Tên viết tắt -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="business_name_abbr" class="form-label mb-0 me-2" style="width: 250px;">Tên
                                    doanh nghiệp (Tên viết tắt)</label>
                                <input type="text" id="business_name_abbr" name="business_name_abbr"
                                    value="{{ old('business_name_abbr', $businessPartner->business_name_abbr ?? '-') }}"
                                    placeholder="Nhập tên viết tắt (nếu có)"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-1" style="width: 180px;">Phân loại <span
                                        class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="partner_category"
                                        id="category_vietnam" value="Việt Nam" required
                                        {{ old('businessPartner_category', $businessPartner->partner_category ?? '-') == 'Việt Nam' ? 'checked' : '' }}
                                        >
                                    <label class="form-check-label" for="category_vietnam">Việt Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="partner_category"
                                        id="category_international" value="Quốc tế" required
                                        {{ old('businessPartner_category', $businessPartner->partner_category ?? '-') == 'Quốc tế' ? 'checked' : '' }}
                                        >
                                    <label class="form-check-label" for="category_international">Quốc tế</label>
                                </div>
                            </div>

                            <!-- Địa chỉ trụ sở chính -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="headquarters_address" class="form-label mb-0 me-2" style="width: 250px;">Địa
                                    chỉ trụ sở chính <span class="text-danger">*</span></label>
                                <input type="text" id="headquarters_address" name="headquarters_address"
                                    value="{{ old('headquarters_address', $businessPartner->headquarters_address ?? '-') }}"
                                    placeholder="Nhập địa chỉ trụ sở chính"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Địa chỉ văn phòng giao dịch -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="branch_address" class="form-label mb-0 me-2" style="width: 250px;">Địa
                                    chỉ văn phòng giao dịch</label>
                                <input type="text" id="branch_address" name="branch_address"
                                    value="{{ old('branch_address', $businessPartner->branch_address ?? '-') }}"
                                    placeholder="Nhập địa chỉ văn phòng giao dịch"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Mã số thuế -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="tax_code" class="form-label mb-0 me-2" style="width: 250px;">Mã số
                                    thuế</label>
                                <input type="text" id="tax_code" name="tax_code"
                                    value="{{ old('tax_code', $businessPartner->tax_code ?? '-') }}"
                                    placeholder="Nhập mã số thuế"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện
                                    thoại <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone"
                                    value="{{ old('phone', $businessPartner->phone ?? '-') }}"
                                    placeholder="Nhập số điện thoại"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Website -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="website" class="form-label mb-0 me-2"
                                    style="width: 250px;">Website</label>
                                <input type="text" id="website" name="website"
                                    value="{{ old('website', $businessPartner->website ?? '-') }}"
                                    placeholder="Nhập website (nếu có)"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>
                        </div>
                    </div>

                    <!-- Lãnh đạo đơn vị -->
                    <div class="col-lg-6 mb-3">
                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            2. Lãnh đạo đơn vị
                        </h3>
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <!-- Họ và tên -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="leader_name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="leader_name" name="leader_name"
                                    value="{{ old('leader_name', $businessPartner->leader_name ?? '-') }}"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Chức vụ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="leader_position" class="form-label mb-0 me-2" style="width: 250px;">Chức
                                    vụ <span class="text-danger">*</span></label>
                                <input type="text" id="leader_position" name="leader_position"
                                    value="{{ old('leader_position', $businessPartner->leader_position ?? '-') }}"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="leader_phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện
                                    thoại <span class="text-danger">*</span></label>
                                <input type="text" id="leader_phone" name="leader_phone"
                                    value="{{ old('leader_phone', $businessPartner->leader_phone ?? '-') }}"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>

                            <!-- Giới tính -->
                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-1" style="width: 180px;">Giới tính <span
                                        class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="leader_gender"
                                        id="gender_male" value="male"
                                        {{ old('leader_gender', $businessPartner->leader_gender ?? '-') == 'male' ? 'checked' : '' }}
                                        >
                                    <label class="form-check-label" for="gender_male">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="leader_gender"
                                        id="gender_female" value="female"
                                        {{ old('leader_gender', $businessPartner->leader_gender ?? '-') == 'female' ? 'checked' : '' }}
                                        >
                                    <label class="form-check-label" for="gender_female">Nữ</label>
                                </div>
                            </div>

                            <!-- Email liên hệ trực tiếp -->
                            <div class="d-flex align-items-center">
                                <label for="leader_email" class="form-label mb-0 me-2" style="width: 250px;">Email
                                    liên hệ trực tiếp <span class="text-danger">*</span></label>
                                <input type="email" id="leader_email" name="leader_email"
                                    value="{{ old('leader_email', $businessPartner->leader_email ?? '-') }}"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    >
                            </div>
                        </div>

                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            3. Phụ trách kết nối</h3>
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <div id="responsible_people">
                                @if ($businessPartner->connector && $businessPartner->connector->isNotEmpty())
                                    @foreach ($businessPartner->connector as $key => $person)
                                        <div class="d-flex align-items-center mb-3">
                                            <label for="name" class="form-label mb-0 me-2"
                                                style="width: 250px;">Họ và tên</label>
                                            <input type="text" id="name" name="responsible_name[]"
                                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                                value="{{ $person->name }}" >
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <label for="position" class="form-label mb-0 me-2"
                                                style="width: 250px;">Chức vụ</label>
                                            <input type="text" id="position" name="responsible_position[]"
                                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                                value="{{ $person->position }}" >
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <label for="phone" class="form-label mb-0 me-2"
                                                style="width: 250px;">Số điện thoại</label>
                                            <input type="text" id="phone" name="responsible_phone[]"
                                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                                value="{{ $person->phone }}" >
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <label class="form-label mb-0 me-1" style="width: 180px;">Giới
                                                tính</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="responsible_gender[{{ $key }}]"
                                                    id="gender_male_{{ $key }}" value="male"
                                                    {{ old('responsible_gender.' . $key, $person->gender) == 'male' ? 'checked' : '' }}
                                                    >
                                                <label class="form-check-label"
                                                    for="gender_male_{{ $key }}">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="responsible_gender[{{ $key }}]"
                                                    id="gender_female_{{ $key }}" value="female"
                                                    {{ old('responsible_gender.' . $key, $person->gender) == 'female' ? 'checked' : '' }}
                                                    >
                                                <label class="form-check-label"
                                                    for="gender_female_{{ $key }}">Nữ</label>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <label for="email" class="form-label mb-0 me-2"
                                                style="width: 250px;">Email liên hệ trực tiếp</label>
                                            <input type="email" id="email" name="responsible_email[]"
                                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                                value="{{ $person->email }}" >
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Họ
                                            và
                                            tên</label>
                                        <input type="text" id="name" name="responsible_name[]" 
                                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                            placeholder="Nhập họ và tên"
                                            value="{{ old('responsible_name.0', $responsible[0]->name ?? '-') }}">
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức
                                            vụ</label>
                                        <input type="text" id="position" name="responsible_position[]" 
                                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                            placeholder="Nhập chức vụ"
                                            value="{{ old('responsible_position.0', $responsible[0]->position ?? '-') }}">
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số
                                            điện
                                            thoại</label>
                                        <input type="text" id="phone" name="responsible_phone[]" 
                                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                            placeholder="Nhập số điện thoại"
                                            value="{{ old('responsible_phone.0', $responsible[0]->phone ?? '-') }}">
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label class="form-label mb-0 me-1" style="width: 180px;">Giới tính</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="responsible_gender[0]"  id="gender_male" value="male"
                                                {{ old('responsible_gender.0', $responsible[0]->gender ?? '-') == 'male' ? 'checked' : '-' }}>
                                            <label class="form-check-label" for="gender_male">Nam</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="responsible_gender[0]"  id="gender_female"
                                                value="female"
                                                {{ old('responsible_gender.0', $responsible[0]->gender ?? '-') == 'female' ? 'checked' : '-' }}>
                                            <label class="form-check-label" for="gender_female">Nữ</label>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="email" class="form-label mb-0 me-2"
                                            style="width: 250px;">Email
                                            liên hệ trực tiếp</label>
                                        <input type="email" id="email" name="responsible_email[]" 
                                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                            placeholder="Nhập email liên hệ"
                                            value="{{ old('responsible_email.0', $responsible[0]->email ?? '-') }}">
                                    </div>
                                @endif
                                <hr class="my-4" style="border: 1px solid #FF7506;">

                            </div>
                            <div class="d-flex justify-content-end mb-2">
                                <button type="button" class="btn btn-outline-primary" onclick="addResponsiblePerson()">Thêm người phụ trách</button>
                            </div>
                        </div>
                        <h3 class="p-2" 
                        style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                        4. Thông tin tài khoản</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <div class="d-flex align-items-center mb-3">
                                <label for="activity_status" class="form-label mb-0 me-2" style="width: 250px;">Thông tin đăng nhập</label>
                                <input type="text" id="activity_status" name="activity_status" disabled
                                value="{{ old('activity_status', $businessPartner->login_code) }}" 
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('activity_status'))
                                    <span class="text-danger ms-2">{{ $errors->first('activity_status') }}</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center">
                                <label for="activity_status" class="form-label mb-0 me-2" style="width: 180px;">Tình trạng hoạt động</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_active" value="1" 
                                        {{ old('status', $businessPartner->status) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_active">Đang hoạt động</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_inactive" value="0" 
                                        {{ old('status', $businessPartner->status) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_inactive">Ngưng hoạt động</label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="text-danger ms-2">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('business_partner.index') }}"
                        class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                    <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    let responsiblePeopleCount = 1; // Bắt đầu với 1 người phụ trách

    // Hàm thêm người phụ trách
    window.addResponsiblePerson = function () {
        let responsibleContainer = document.getElementById("responsible_people");
        let newPerson = `
            <div class="d-flex align-items-center mb-3">
                <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên</label>
                <input type="text" id="name" name="responsible_name[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                        placeholder="Nhập họ và tên" value="{{ old('responsible_name.0') }}">
            </div>

            <div class="d-flex align-items-center mb-3">
                <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ</label>
                <input type="text" id="position" name="responsible_position[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                        placeholder="Nhập chức vụ" value="{{ old('responsible_position.0') }}">
            </div>

            <div class="d-flex align-items-center mb-3">
                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                <input type="text" id="phone" name="responsible_phone[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                        placeholder="Nhập số điện thoại" value="{{ old('responsible_phone.0') }}">
            </div>
            <div class="d-flex align-items-center mb-3">
                <label class="form-label mb-0 me-2" style="width: 180px;">Giới tính</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="responsible_gender[]" id="gender_male${responsiblePeopleCount}" value="male">
                    <label class="form-check-label" for="gender_male${responsiblePeopleCount}">Nam</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="responsible_gender[]" id="gender_female${responsiblePeopleCount}" value="female">
                    <label class="form-check-label" for="gender_female${responsiblePeopleCount}">Nữ</label>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3">
                <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email liên hệ trực tiếp</label>
                <input type="email" id="email" name="responsible_email[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                        placeholder="Nhập email liên hệ" value="{{ old('responsible_email.0') }}">
            </div>
            <hr class="my-4" style="border: 1px solid #FF7506;">
        `;
        // Chèn người phụ trách mới vào trước nút "Thêm người phụ trách"
        responsibleContainer.insertAdjacentHTML("beforeend", newPerson);
        responsiblePeopleCount++;
    };
});
</script>