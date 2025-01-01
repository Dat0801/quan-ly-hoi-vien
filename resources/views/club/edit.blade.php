<x-app-layout>
    <div class="d-flex align-items-start" style="margin-right: 110px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
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
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">Chỉnh sửa câu lạc bộ</h1>

            <form action="{{ route('club.update', $club->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Ô 1: Thông tin cơ bản -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">1. Thông tin cơ bản</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                        
                            <!-- Mã câu lạc bộ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="club_code" class="form-label mb-0 me-2" style="width: 250px;">Mã câu lạc bộ</label>
                                <input type="text" id="club_code" name="club_code" value="{{ old('club_code', $club->club_code) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Tên câu lạc bộ (Tiếng Việt) -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="name_vi" class="form-label mb-0 me-2" style="width: 250px;">Tên Tiếng Việt</label>
                                <input type="text" id="name_vi" name="name_vi" value="{{ old('name_vi', $club->name_vi) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Tên câu lạc bộ (Tiếng Anh) -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="name_en" class="form-label mb-0 me-2" style="width: 250px;">Tên Tiếng Anh</label>
                                <input type="text" id="name_en" name="name_en" value="{{ old('name_en', $club->name_en) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Tên viết tắt -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="name_abbr" class="form-label mb-0 me-2" style="width: 250px;">Tên viết tắt</label>
                                <input type="text" id="name_abbr" name="name_abbr" value="{{ old('name_abbr', $club->name_abbr) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Địa chỉ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="address" class="form-label mb-0 me-2" style="width: 250px;">Địa chỉ</label>
                                <input type="text" id="address" name="address" value="{{ old('address', $club->address) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Mã số thuế -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="tax_code" class="form-label mb-0 me-2" style="width: 250px;">Mã số thuế</label>
                                <input type="text" id="tax_code" name="tax_code" value="{{ old('tax_code', $club->tax_code) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $club->phone) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Email -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $club->email) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Website -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="website" class="form-label mb-0 me-2" style="width: 250px;">Website</label>
                                <input type="text" id="website" name="website" value="{{ old('website', $club->website) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <label for="fanpage" class="form-label mb-0 me-2" style="width: 250px;">Fanpage</label>
                                <input type="text" id="fanpage" name="fanpage" value="{{ old('fanpage', $club->fanpage) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Ngày thành lập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="established_date" class="form-label mb-0 me-2" style="width: 250px;">Ngày thành lập</label>
                                <input type="date" id="established_date" name="established_date" value="{{ old('established_date', $club->established_date) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>

                            <!-- Quyết định thành lập -->
                            <div class="d-flex align-items-center">
                                <label for="established_decision" class="form-label mb-0 me-2" style="width: 250px;">Quyết định thành lập</label>
                                <input type="text" id="established_decision" name="established_decision" value="{{ old('established_decision', $club->established_decision) }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                            </div>
                        </div>
                    </div>

                    <!-- Ô 2: Ngành - Lĩnh vực -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">2. Ngành - Lĩnh vực</h3>
                        <div>
                            <div class="border" style="padding: 20px; border-radius: 10px;">
                                <div class="d-flex align-items-center mb-3">
                                    <label for="industry" class="form-label mb-0 me-2" style="width: 250px;">Ngành</label>
                                    <select id="industry" name="industry_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                        <option value="">Chọn ngành</option>
                                        @foreach ($industries as $industry) 
                                            <option value="{{ $industry->id }}" {{ old('industry', $club->industry_id) == $industry->id ? 'selected' : '' }}>
                                                {{ $industry->industry_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Lĩnh vực -->
                                <div class="d-flex align-items-center mb-3">
                                    <label for="field_id" class="form-label mb-0 me-2" style="width: 250px;">Lĩnh vực</label>
                                    <select id="field_id" name="field_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                        <option value="">Chọn lĩnh vực</option>
                                        @foreach ($fields as $field) 
                                            <option value="{{ $field->id }}" {{ old('field_id', $club->field_id) == $field->id ? 'selected' : '' }}>
                                                {{ $field->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Thị trường -->
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">3. Thị trường</h3>
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <div class="d-flex align-items-center mb-3">
                                <label for="market" class="form-label mb-0 me-2" style="width: 250px;">Thị trường</label>
                                <select id="market" name="market_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                    <option value="">Chọn thị trường</option>
                                    @foreach ($markets as $market) 
                                        <option value="{{ $market->id }}" {{ old('market', $club->market_id) == $market->id ? 'selected' : '' }}>
                                            {{ $market->market_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Phụ trách kết nối -->
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">4. Phụ trách kết nối</h3>
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <div id="responsible_people">
                                @if($club->connector && $club->connector->isNotEmpty())
                                    @foreach ($club->connector as $key => $person)
                                        <div class="d-flex align-items-center mb-3">
                                            <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên</label>
                                            <input type="text" id="name" name="responsible_name[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" value="{{ old('responsible_name.' . $key, $person->name) }}">
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ</label>
                                            <input type="text" id="position" name="responsible_position[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" value="{{ old('responsible_position.' . $key, $person->position) }}">
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                                            <input type="text" id="phone" name="responsible_phone[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" value="{{ old('responsible_phone.' . $key, $person->phone) }}">
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <label class="form-label mb-0 me-1" style="width: 180px;">Giới tính</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="responsible_gender[{{ $key }}]" id="gender_male_{{ $key }}" value="male" {{ old('responsible_gender.' . $key, $person->gender) == 'male' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gender_male_{{ $key }}">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="responsible_gender[{{ $key }}]" id="gender_female_{{ $key }}" value="female" {{ old('responsible_gender.' . $key, $person->gender) == 'female' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gender_female_{{ $key }}">Nữ</label>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-3">
                                            <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email liên hệ trực tiếp</label>
                                            <input type="email" id="email" name="responsible_email[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" value="{{ old('responsible_email.' . $key, $person->email) }}">
                                        </div>

                                        <hr class="my-4" style="border: 1px solid #FF7506;">
                                    @endforeach
                                @else
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên</label>
                                        <input type="text" id="name" name="responsible_name[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" placeholder="Nhập họ và tên" value="{{ old('responsible_name.0') }}">
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ</label>
                                        <input type="text" id="position" name="responsible_position[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" placeholder="Nhập chức vụ" value="{{ old('responsible_position.0') }}">
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                                        <input type="text" id="phone" name="responsible_phone[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" placeholder="Nhập số điện thoại" value="{{ old('responsible_phone.0') }}">
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label class="form-label mb-0 me-1" style="width: 180px;">Giới tính</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="responsible_gender[0]" id="gender_male" value="male" {{ old('responsible_gender.0') == 'male' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender_male">Nam</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="responsible_gender[0]" id="gender_female" value="female" {{ old('responsible_gender.0') == 'female' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gender_female">Nữ</label>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email liên hệ trực tiếp</label>
                                        <input type="email" id="email" name="responsible_email[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" placeholder="Nhập email liên hệ" value="{{ old('responsible_email.0') }}">
                                    </div>

                                    <hr class="my-4" style="border: 1px solid #FF7506;">
                                @endif

                            </div>
                            <!-- Nút Thêm người phụ trách -->
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary" onclick="addResponsiblePerson()">Thêm người phụ trách</button>
                            </div>
                        </div>
                    </div>

                    <!-- Nút Lưu -->
                    <div class="d-flex justify-content-center gap-3 mt-2">
                        <a href="{{ route('club.index') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                        <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Lưu</button>
                    </div>
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
