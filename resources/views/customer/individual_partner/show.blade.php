<x-app-layout>
    <div style="margin-right: 110px;">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    <div class="d-flex align-items-start" style="margin-right: 110px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
            <h1
                style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                Chi tiết đối tác
            </h1>

            <div class="row">
                <!-- Section 1: Personal Information -->
                <div class="col-lg-6">
                    <h3 class="p-2"
                        style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                        1. Thông tin cá nhân
                    </h3>
                    <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                        <!-- Login Code -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="login_code" class="form-label mb-0 me-2" style="width: 250px;">
                                Mã đăng nhập
                            </label>
                            <input type="text" id="login_code" name="login_code"
                                value="{{ $partner->login_code ?? '-' }}"
                                class="form-control border-gray-300 shadow-sm flex-grow-1" disabled>
                        </div>

                        <!-- Card Code -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="card_code" class="form-label mb-0 me-2" style="width: 250px;">
                                Mã thẻ
                            </label>
                            <input type="text" id="card_code" name="card_code"
                                value="{{ $partner->card_code ?? '-' }}"
                                class="form-control border-gray-300 shadow-sm flex-grow-1" disabled>
                        </div>

                        <!-- Full Name -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="full_name" class="form-label mb-0 me-2" style="width: 250px;">
                                Họ và tên
                            </label>
                            <input type="text" id="full_name" name="full_name"
                                value="{{ $partner->full_name ?? '-' }}"
                                class="form-control border-gray-300 shadow-sm flex-grow-1" disabled>
                        </div>

                        <!-- Position -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="position" class="form-label mb-0 me-2" style="width: 250px;">
                                Chức vụ
                            </label>
                            <input type="text" id="position" name="position" value="{{ $partner->position ?? '-' }}"
                                class="form-control border-gray-300 shadow-sm flex-grow-1" disabled>
                        </div>

                        <!-- Phone Number -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">
                                Số điện thoại
                            </label>
                            <input type="text" id="phone" name="phone" value="{{ $partner->phone ?? '-' }}"
                                class="form-control border-gray-300 shadow-sm flex-grow-1" disabled>
                        </div>

                        <!-- Partner Category -->
                        <div class="d-flex align-items-center mb-3">
                            <label class="form-label mb-0 me-1" style="width: 180px;">Phân loại</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="partner_category"
                                    id="category_vietnam" value="Việt Nam"
                                    {{ $partner->partner_category == 'Việt Nam' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="category_vietnam">Việt Nam</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="partner_category"
                                    id="category_international" value="Quốc tế"
                                    {{ $partner->partner_category == 'Quốc tế' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="category_international">Quốc tế</label>
                            </div>
                        </div>

                        <!-- Unit -->
                        <div class="d-flex align-items-center">
                            <label for="unit" class="form-label mb-0 me-2" style="width: 250px;">
                                Đơn vị
                            </label>
                            <input type="text" id="unit" name="unit" value="{{ $partner->unit ?? '-' }}"
                                class="form-control border-gray-300 shadow-sm flex-grow-1" disabled>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Professional Information -->
                <div class="col-lg-6">
                    <h3 class="p-2"
                        style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                        2. Thông tin nghề nghiệp
                    </h3>
                    <div class="border" style="border-radius: 10px; padding: 20px;">
                        <!-- Industry -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="industry" class="form-label mb-0 me-2" style="width: 250px;">
                                Ngành
                            </label>
                            <input type="text" id="industry" name="industry"
                                value="{{ $partner->industry->industry_name ?? '-' }}"
                                class="form-control border-gray-300 shadow-sm flex-grow-1" disabled>
                        </div>

                        <!-- Field -->
                        <div class="d-flex align-items-center">
                            <label for="field" class="form-label mb-0 me-2" style="width: 250px;">
                                Lĩnh vực
                            </label>
                            <input type="text" id="field" name="field"
                                value="{{ $partner->field->name ?? '-' }}"
                                class="form-control border-gray-300 shadow-sm flex-grow-1" disabled>
                        </div>
                    </div>

                    <h3 class="p-2"
                        style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                        3. Thông tin tài khoản</h3>
                    <div class="border" style="border-radius: 10px; padding: 20px;">
                        <div class="d-flex align-items-center mb-3">
                            <label for="activity_status" class="form-label mb-0 me-2" style="width: 250px;">Thông tin
                                đăng nhập</label>
                            <input type="text" id="activity_status" name="activity_status"
                                value="{{ old('activity_status', $partner->login_code) }}"
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                {{ isset($partner) ? 'disabled' : '' }}>
                            @if ($errors->has('activity_status'))
                                <span class="text-danger ms-2">{{ $errors->first('activity_status') }}</span>
                            @endif
                        </div>

                        <div class="d-flex align-items-center">
                            <label for="activity_status" class="form-label mb-0 me-2" style="width: 180px;">Tình
                                trạng hoạt động</label>
                            <span class="badge {{ $partner->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $partner->status ? 'Đang hoạt động' : 'Ngưng hoạt động' }}
                            </span>
                            @if ($errors->has('activity_status'))
                                <span class="text-danger ms-2">{{ $errors->first('activity_status') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('individual_partner.index') }}"
                    class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Đóng</a>
                <a href="{{ route('individual_partner.edit', $partner->id) }}"
                    class="btn btn-primary w-48 py-3 sm:rounded-lg">Chỉnh sửa</a>
            </div>
        </div>
    </div>
</x-app-layout>
