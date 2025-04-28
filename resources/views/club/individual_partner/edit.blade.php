<x-app-layout>
    <div style="margin-right: 110px;">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    <div class="d-flex align-items-start" style="margin-right: 110px;">
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 85vh; overflow-y: auto;">
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                Chỉnh sửa đối tác
            </h1>

            <form action="{{ route('club.individual_partner.update', [$club->id,$partner->id]) }}" method="POST">
                @csrf
                @method('PUT')
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
                                <input type="text" id="login_code" name="login_code" 
                                    value="{{ old('login_code', $partner->login_code) }}"  required
                                    class="form-control border-gray-300 shadow-sm flex-grow-1">
                            </div>

                            <!-- Card Code -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="card_code" class="form-label mb-0 me-2" style="width: 250px;">
                                    Mã thẻ <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="card_code" name="card_code" 
                                    value="{{ old('card_code', $partner->card_code) }}"  required
                                    class="form-control border-gray-300 shadow-sm flex-grow-1">
                            </div>

                            <!-- Full Name -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="full_name" class="form-label mb-0 me-2" style="width: 250px;">
                                    Họ và tên <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="full_name" name="full_name" required
                                    value="{{ old('full_name', $partner->full_name) }}" 
                                    class="form-control border-gray-300 shadow-sm flex-grow-1">
                            </div>

                            <!-- Position -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="position" class="form-label mb-0 me-2" style="width: 250px;">
                                    Chức vụ
                                </label>
                                <input type="text" id="position" name="position" 
                                    value="{{ old('position', $partner->position) }}" 
                                    class="form-control border-gray-300 shadow-sm flex-grow-1">
                            </div>

                            <!-- Phone Number -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">
                                    Số điện thoại <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="phone" name="phone" 
                                    value="{{ old('phone', $partner->phone) }}" required
                                    class="form-control border-gray-300 shadow-sm flex-grow-1">
                            </div>

                            <!-- Partner Category -->
                            <div class="d-flex align-items-center mb-3">
                                <label class="form-label mb-0 me-1" style="width: 180px;">Phân loại <span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="partner_category" id="category_vietnam" value="Việt Nam" required
                                        {{ old('partner_category', $partner->partner_category) == 'Việt Nam' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category_vietnam">Việt Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="partner_category" id="category_international" value="Quốc tế" required
                                        {{ old('partner_category', $partner->partner_category) == 'Quốc tế' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category_international">Quốc tế</label>
                                </div>
                            </div>

                            <!-- Unit -->
                            <div class="d-flex align-items-center">
                                <label for="unit" class="form-label mb-0 me-2" style="width: 250px;">
                                    Đơn vị
                                </label>
                                <input type="text" id="unit" name="unit" 
                                    value="{{ old('unit', $partner->unit) }}" 
                                    class="form-control border-gray-300 shadow-sm flex-grow-1">
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Professional Information -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            2. Thông tin nghề nghiệp
                        </h3>
                        <div class="border" style="border-radius: 10px; padding: 20px;">
                            <!-- Industry -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="industry" class="form-label mb-0 me-2" style="width: 250px;">
                                    Ngành
                                </label>
                                <select id="industry" name="industry_id" class="form-control border-gray-300 shadow-sm flex-grow-1">
                                    <option value="">-- Chọn ngành --</option>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry->id }}" {{ old('industry_id', $partner->industry_id) == $industry->id ? 'selected' : '' }}>
                                            {{ $industry->industry_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Field -->
                            <div class="d-flex align-items-center">
                                <label for="field" class="form-label mb-0 me-2" style="width: 250px;">
                                    Lĩnh vực
                                </label>
                                <select id="field" name="field_id" class="form-control border-gray-300 shadow-sm flex-grow-1">
                                    <option value="">-- Chọn lĩnh vực --</option>
                                    @foreach ($fields as $field)
                                        <option value="{{ $field->id }}" {{ old('field_id', $partner->field_id) == $field->id ? 'selected' : '' }}>
                                            {{ $field->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            3. Thông tin tài khoản</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <div class="d-flex align-items-center mb-3">
                                <label for="activity_status" class="form-label mb-0 me-2" style="width: 250px;">Thông
                                    tin đăng nhập</label>
                                <input type="text" id="activity_status" name="activity_status"
                                    value="{{ old('activity_status', $partner->login_code) }}"
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
                                        value="1" {{ old('status', $partner->status) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_active">Đang hoạt động</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                        id="status_inactive" value="0"
                                        {{ old('status', $partner->status) == '0' ? 'checked' : '' }}>
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
                    <x-cancel-button :route="route('club.individual_partner.index', $club->id)">
                        Hủy
                    </x-cancel-button>
                    <x-primary-button>
                        Lưu
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
