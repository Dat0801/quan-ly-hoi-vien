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
                Thêm đối tác
            </h1>

            <form action="{{ route('club.individual_partner.store', $club->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Section 1: Personal Information -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            1. Thông tin cá nhân
                        </h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Login Code -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="login_code" class="form-label mb-0 me-2" style="width: 250px;">
                                    Mã đăng nhập <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="login_code" name="login_code" value="{{ old('login_code') }}"
                                    placeholder="Nhập mã đăng nhập" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('login_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('login_code') }}</span>
                                @endif
                            </div>

                            <!-- Card Code -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="card_code" class="form-label mb-0 me-2" style="width: 250px;">
                                    Mã thẻ <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="card_code" name="card_code" value="{{ old('card_code') }}"
                                    placeholder="Nhập mã thẻ" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('card_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('card_code') }}</span>
                                @endif
                            </div>

                            <!-- Full Name -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="full_name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                                    placeholder="Nhập họ và tên" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('full_name'))
                                    <span class="text-danger ms-2">{{ $errors->first('full_name') }}</span>
                                @endif
                            </div>

                            <!-- Position -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ</label>
                                <input type="text" id="position" name="position" value="{{ old('position') }}"
                                    placeholder="Nhập chức vụ" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('position'))
                                    <span class="text-danger ms-2">{{ $errors->first('position') }}</span>
                                @endif
                            </div>

                            <!-- Phone Number -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="Nhập số điện thoại" required
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('phone'))
                                    <span class="text-danger ms-2">{{ $errors->first('phone') }}</span>
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

                            <!-- Unit -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="unit" class="form-label mb-0 me-2" style="width: 250px;">Đơn vị</label>
                                <input type="text" id="unit" name="unit" value="{{ old('unit') }}"
                                    placeholder="Nhập đơn vị" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('unit'))
                                    <span class="text-danger ms-2">{{ $errors->first('unit') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Professional Information -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            2. Thông tin nghề nghiệp
                        </h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Industry -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="industry" class="form-label mb-0 me-2" style="width: 250px;">Ngành</label>
                                <select id="industry" name="industry_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                    <option value="">-- Chọn ngành --</option>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry->id }}" {{ old('industry_id') == $industry->id ? 'selected' : '' }}>
                                            {{ $industry->industry_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('industry_id'))
                                    <span class="text-danger ms-2">{{ $errors->first('industry_id') }}</span>
                                @endif
                            </div>

                            <!-- Field -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="field" class="form-label mb-0 me-2" style="width: 250px;">Lĩnh vực</label>
                                <select id="field" name="field_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                    <option value="">-- Chọn lĩnh vực --</option>
                                    @foreach ($fields as $field)
                                        <option value="{{ $field->id }}" {{ old('field_id') == $field->id ? 'selected' : '' }}>
                                            {{ $field->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('field_id'))
                                    <span class="text-danger ms-2">{{ $errors->first('field_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('club.individual_partner.index', $club->id) }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                    <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
