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
                Thêm câu lạc bộ</h1>

            <form action="{{ route('club.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Ô 1: Thông tin cơ bản -->
                    <div class="col-lg-6">
                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            1. Thông tin cơ bản</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">

                            <!-- Mã câu lạc bộ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="club_code" class="form-label mb-0 me-2" style="width: 250px;">Mã câu lạc bộ
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="club_code" name="club_code" value="{{ old('club_code') }}"
                                    placeholder="Nhập mã câu lạc bộ"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('club_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('club_code') }}</span>
                                @endif
                            </div>

                            <!-- Tên câu lạc bộ (Tiếng Việt) -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="name_vi" class="form-label mb-0 me-2" style="width: 250px;">Tên Tiếng Việt
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="name_vi" name="name_vi" value="{{ old('name_vi') }}"
                                    placeholder="Nhập tên tiếng Việt"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('name_vi'))
                                    <span class="text-danger ms-2">{{ $errors->first('name_vi') }}</span>
                                @endif
                            </div>

                            <!-- Tên câu lạc bộ (Tiếng Anh) -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="name_en" class="form-label mb-0 me-2" style="width: 250px;">Tên Tiếng
                                    Anh</label>
                                <input type="text" id="name_en" name="name_en" value="{{ old('name_en') }}"
                                    placeholder="Nhập tên tiếng Anh (nếu có)"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('name_en'))
                                    <span class="text-danger ms-2">{{ $errors->first('name_en') }}</span>
                                @endif
                            </div>

                            <!-- Tên viết tắt -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="name_abbr" class="form-label mb-0 me-2" style="width: 250px;">Tên viết
                                    tắt</label>
                                <input type="text" id="name_abbr" name="name_abbr" value="{{ old('name_abbr') }}"
                                    placeholder="Nhập tên viết tắt (nếu có)"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('name_abbr'))
                                    <span class="text-danger ms-2">{{ $errors->first('name_abbr') }}</span>
                                @endif
                            </div>

                            <!-- Địa chỉ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="address" class="form-label mb-0 me-2" style="width: 250px;">Địa chỉ</label>
                                <input type="text" id="address" name="address" value="{{ old('address') }}"
                                    placeholder="Nhập địa chỉ"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('address'))
                                    <span class="text-danger ms-2">{{ $errors->first('address') }}</span>
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
                                    thoại</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="Nhập số điện thoại"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('phone'))
                                    <span class="text-danger ms-2">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <!-- Email -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Nhập email"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('email'))
                                    <span class="text-danger ms-2">{{ $errors->first('email') }}</span>
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

                            <div class="d-flex align-items-center mb-3">
                                <label for="fanpage" class="form-label mb-0 me-2"
                                    style="width: 250px;">Fanpage</label>
                                <input type="text" id="fanpage" name="fanpage" value="{{ old('fanpage') }}"
                                    placeholder="Nhập đường dẫn fanpage (nếu có)"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('fanpage'))
                                    <span class="text-danger ms-2">{{ $errors->first('fanpage') }}</span>
                                @endif
                            </div>

                            <!-- Ngày thành lập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="established_date" class="form-label mb-0 me-2" style="width: 250px;">Ngày
                                    thành lập</label>
                                <input type="date" id="established_date" name="established_date"
                                    value="{{ old('established_date') }}"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('established_date'))
                                    <span class="text-danger ms-2">{{ $errors->first('established_date') }}</span>
                                @endif
                            </div>

                            <!-- Quyết định thành lập -->
                            <div class="d-flex align-items-center">
                                <label for="established_decision" class="form-label mb-0 me-2"
                                    style="width: 250px;">Quyết định thành lập</label>
                                <input type="text" id="established_decision" name="established_decision"
                                    value="{{ old('established_decision') }}" placeholder="Nhập quyết định thành lập"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('established_decision'))
                                    <span class="text-danger ms-2">{{ $errors->first('established_decision') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            2. Ngành - Lĩnh vực</h3>
                        <!-- Ô 2: Ngành - Lĩnh vực -->
                        <div class="mb-3">
                            <div class="border" style="padding: 20px; border-radius: 10px;">
                                <!-- Ngành -->
                                <div class="d-flex align-items-center mb-3">
                                    <label for="industry" class="form-label mb-0 me-2" style="width: 250px;">Ngành
                                        <span class="text-danger">*</span></label>
                                    <select id="industry" name="industry_id"
                                        class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required>
                                        <option value="">-- Chọn ngành --</option>
                                        @foreach ($industries as $industry)
                                            <option value="{{ $industry->id }}"
                                                {{ old('industry_id') == $industry->id ? 'selected' : '' }}>
                                                {{ $industry->industry_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Lĩnh vực -->
                                <div class="d-flex align-items-center">
                                    <label for="field_id" class="form-label mb-0 me-2" style="width: 250px;">Lĩnh vực
                                        <span class="text-danger">*</span></label>
                                    <select id="field_id" name="field_id"
                                        class="form-select border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required>
                                        <option value="">-- Chọn lĩnh vực --</option>
                                        @foreach ($fields as $field)
                                            <option value="{{ $field->id }}"
                                                {{ old('field_id') == $field->id ? 'selected' : '' }}>
                                                {{ $field->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('field_id'))
                                        <span class="text-danger ms-2">{{ $errors->first('field_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <h3 class="p-2"
                                style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                                3. Thị trường</h3>
                            <div class="border" style="padding: 20px; border-radius: 10px;">
                                <div class="d-flex align-items-center">
                                    <label for="market" class="form-label mb-0 me-2" style="width: 250px;">Thị
                                        trường <span class="text-danger">*</span></label>
                                    <select id="market" name="market_id"
                                        class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                        required>
                                        <option value="">-- Chọn thị trường --</option>
                                        @foreach ($markets as $market)
                                            <option value="{{ $market->id }}"
                                                {{ old('market_id') == $market->id ? 'selected' : '' }}>
                                                {{ $market->market_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <h3 class="p-2"
                                style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                                4. Phụ trách kết nối</h3>
                            <!-- Thông tin phụ trách -->
                            <div class="border" style="padding: 20px; border-radius: 10px;">
                                <div id="responsible_people">
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Họ
                                            và tên</label>
                                        <input type="text" id="name" name="responsible_name[]"
                                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                            placeholder="Nhập họ và tên" value="{{ old('responsible_name.0') }}">
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức
                                            vụ</label>
                                        <input type="text" id="position" name="responsible_position[]"
                                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                            placeholder="Nhập chức vụ" value="{{ old('responsible_position.0') }}">
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số
                                            điện thoại</label>
                                        <input type="text" id="phone" name="responsible_phone[]"
                                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                            placeholder="Nhập số điện thoại"
                                            value="{{ old('responsible_phone.0') }}">
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label class="form-label mb-0 me-1" style="width: 180px;">Giới tính</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="responsible_gender[0]" id="gender_male" value="male"
                                                {{ old('responsible_gender.0') == 'male' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender_male">Nam</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="responsible_gender[0]" id="gender_female" value="female"
                                                {{ old('responsible_gender.0') == 'female' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender_female">Nữ</label>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="email" class="form-label mb-0 me-2"
                                            style="width: 250px;">Email liên hệ trực tiếp</label>
                                        <input type="email" id="email" name="responsible_email[]"
                                            class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                            placeholder="Nhập email liên hệ"
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
                    </div>
                    <!-- Nút Lưu và Hủy -->
                    <div class="d-flex justify-content-center gap-3">
                        <x-cancel-button :route="route('club.index')">
                            Hủy
                        </x-cancel-button>
                        <x-primary-button >
                            Thêm
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let responsiblePeopleCount = 1; // Bắt đầu với 1 người phụ trách

        // Hàm thêm người phụ trách
        window.addResponsiblePerson = function() {
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
