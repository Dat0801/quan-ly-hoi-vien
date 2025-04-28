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
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">Thêm khách hàng</h1>

            <form action="{{ route('business_customer.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Ô 1: Thông tin cơ bản -->
                    <div class="col-lg-6 mb-3">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">1. Thông tin cơ bản</h3>
                        <div class="border" style="border-radius: 10px; padding: 20px;">
                            <!-- Mã đăng nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="login_code" class="form-label mb-0 me-2" style="width: 250px;">Mã đăng nhập <span class="text-danger">*</span></label>
                                <input type="text" id="login_code" name="login_code" value="{{ old('login_code') }}" placeholder="Nhập mã đăng nhập" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('login_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('login_code') }}</span>
                                @endif
                            </div>

                            <!-- Mã thẻ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="card_code" class="form-label mb-0 me-2" style="width: 250px;">Mã thẻ <span class="text-danger">*</span></label>
                                <input type="text" id="card_code" name="card_code" value="{{ old('card_code') }}" placeholder="Nhập mã thẻ" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('card_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('card_code') }}</span>
                                @endif
                            </div>

                            <!-- Tên doanh nghiệp (Tiếng Việt) -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="business_name_vi" class="form-label mb-0 me-2" style="width: 250px;">Tên Tiếng Việt <span class="text-danger">*</span></label>
                                <input type="text" id="business_name_vi" name="business_name_vi" value="{{ old('business_name_vi') }}" placeholder="Nhập tên tiếng Việt" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('business_name_vi'))
                                    <span class="text-danger ms-2">{{ $errors->first('business_name_vi') }}</span>
                                @endif
                            </div>

                            <!-- Tên doanh nghiệp (Tiếng Anh) -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="business_name_en" class="form-label mb-0 me-2" style="width: 250px;">Tên Tiếng Anh</label>
                                <input type="text" id="business_name_en" name="business_name_en" value="{{ old('business_name_en') }}" placeholder="Nhập tên tiếng Anh (nếu có)" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('business_name_en'))
                                    <span class="text-danger ms-2">{{ $errors->first('business_name_en') }}</span>
                                @endif
                            </div>

                            <!-- Tên viết tắt -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="business_name_abbr" class="form-label mb-0 me-2" style="width: 250px;">Tên viết tắt</label>
                                <input type="text" id="business_name_abbr" name="business_name_abbr" value="{{ old('business_name_abbr') }}" placeholder="Nhập tên viết tắt (nếu có)" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('business_name_abbr'))
                                    <span class="text-danger ms-2">{{ $errors->first('business_name_abbr') }}</span>
                                @endif
                            </div>

                            <!-- Địa chỉ trụ sở chính -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="headquarters_address" class="form-label mb-0 me-2" style="width: 250px;">Địa chỉ trụ sở chính <span class="text-danger">*</span></label>
                                <input type="text" id="headquarters_address" name="headquarters_address" 
                                value="{{ old('headquarters_address') }}" placeholder="Nhập địa chỉ trụ sở chính" 
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('headquarters_address'))
                                    <span class="text-danger ms-2">{{ $errors->first('headquarters_address') }}</span>
                                @endif
                            </div>

                            <!-- Địa chỉ văn phòng giao dịch -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="branch_address" class="form-label mb-0 me-2" style="width: 250px;">Địa chỉ văn phòng giao dịch</label>
                                <input type="text" id="branch_address" name="branch_address" value="{{ old('branch_address') }}" placeholder="Nhập địa chỉ văn phòng giao dịch" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('branch_address'))
                                    <span class="text-danger ms-2">{{ $errors->first('branch_address') }}</span>
                                @endif
                            </div>

                            <!-- Mã số thuế -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="tax_code" class="form-label mb-0 me-2" style="width: 250px;">Mã số thuế</label>
                                <input type="text" id="tax_code" name="tax_code" value="{{ old('tax_code') }}" placeholder="Nhập mã số thuế" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('tax_code'))
                                    <span class="text-danger ms-2">{{ $errors->first('tax_code') }}</span>
                                @endif
                            </div>

                            <!-- Số điện thoại -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" 
                                value="{{ old('phone') }}" placeholder="Nhập số điện thoại" 
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                @if ($errors->has('phone'))
                                    <span class="text-danger ms-2">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <!-- Website -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="website" class="form-label mb-0 me-2" style="width: 250px;">Website</label>
                                <input type="text" id="website" name="website" value="{{ old('website') }}" placeholder="Nhập website (nếu có)" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('website'))
                                    <span class="text-danger ms-2">{{ $errors->first('website') }}</span>
                                @endif
                            </div>

                            <!-- Fanpage -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="fanpage" class="form-label mb-0 me-2" style="width: 250px;">Fanpage</label>
                                <input type="text" id="fanpage" name="fanpage" value="{{ old('fanpage') }}" placeholder="Nhập đường dẫn fanpage (nếu có)" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('fanpage'))
                                    <span class="text-danger ms-2">{{ $errors->first('fanpage') }}</span>
                                @endif
                            </div>

                            <!-- Ngày thành lập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="established_date" class="form-label mb-0 me-2" style="width: 250px;">Ngày thành lập</label>
                                <input type="date" id="established_date" name="established_date" value="{{ old('established_date') }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('established_date'))
                                    <span class="text-danger ms-2">{{ $errors->first('established_date') }}</span>
                                @endif
                            </div>

                            <!-- Vốn điều lệ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="charter_capital" class="form-label mb-0 me-2" style="width: 250px;">Vốn điều lệ</label>
                                <input type="number" id="charter_capital" name="charter_capital" value="{{ old('charter_capital') }}" placeholder="Nhập vốn điều lệ" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" step="0.01">
                                @if ($errors->has('charter_capital'))
                                    <span class="text-danger ms-2">{{ $errors->first('charter_capital') }}</span>
                                @endif
                            </div>

                            <!-- Doanh thu trước gia nhập -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="pre_membership_revenue" class="form-label mb-0 me-2" style="width: 250px;">Doanh thu trước gia nhập</label>
                                <input type="number" id="pre_membership_revenue" name="pre_membership_revenue" value="{{ old('pre_membership_revenue') }}" placeholder="Nhập doanh thu trước gia nhập" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" step="0.01">
                                @if ($errors->has('pre_membership_revenue'))
                                    <span class="text-danger ms-2">{{ $errors->first('pre_membership_revenue') }}</span>
                                @endif
                            </div>

                            <!-- Email -->
                            <div class="d-flex align-items-center">
                                <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                placeholder="Nhập email (nếu có)" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                @if ($errors->has('email'))
                                    <span class="text-danger ms-2">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">2. Ngành - Lĩnh vực</h3>
                        <!-- Ô 2: Ngành - Lĩnh vực -->
                        <div>
                            <div class="border" style="padding: 20px; border-radius: 10px;">
                                <!-- Ngành -->
                                <div class="d-flex align-items-center mb-3">
                                    <label for="industry" class="form-label mb-0 me-2" style="width: 250px;">Ngành <span class="text-danger">*</span></label>
                                    <select id="industry" name="industry_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                        <option value="">-- Chọn ngành --</option>
                                        @foreach($industries as $industry)
                                            <option value="{{ $industry->id }}" {{ old('industry_id') == $industry->id ? 'selected' : '' }}>{{ $industry->industry_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              
                                <!-- Lĩnh vực -->
                                <div class="d-flex align-items-center">
                                    <label for="field_id" class="form-label mb-0 me-2" style="width: 250px;">Lĩnh vực <span class="text-danger">*</span></label>
                                    <select id="field_id" name="field_id" class="form-select border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                        <option value="">-- Chọn lĩnh vực --</option>
                                        @foreach ($fields as $field)
                                            <option value="{{ $field->id }}" {{ old('field_id') == $field->id ? 'selected' : '' }}>{{ $field->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('field_id'))
                                        <span class="text-danger ms-2">{{ $errors->first('field_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">3. Thị trường</h3>
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <div class="d-flex align-items-center">
                                <label for="market" class="form-label mb-0 me-2" style="width: 250px;">Thị trường <span class="text-danger">*</span></label>
                                <select id="market" name="market_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                    <option value="">-- Chọn thị trường --</option>
                                    @foreach($markets as $market)
                                        <option value="{{ $market->id }}" {{ old('market_id') == $market->id ? 'selected' : '' }}>{{ $market->market_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">4. Khách hàng mục tiêu</h3>
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <div class="d-flex align-items-center">
                                <label for="target_customer_group" class="form-label mb-0 me-2" style="width: 250px;">Khách hàng mục tiêu <span class="text-danger">*</span></label>
                                <select id="target_customer_group" name="target_customer_group_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" required>
                                    <option value="">-- Chọn khách hàng mục tiêu --</option>
                                    @foreach($targetCustomerGroups as $target_customer_group)
                                        <option value="{{ $target_customer_group->id }}" {{ old('target_customer_group_id') == $target_customer_group->id ? 'selected' : '' }}>
                                            {{ $target_customer_group->group_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 mb-3">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">5. Quy mô doanh nghiệp</h3>
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <div class="d-flex justify-content-between w-100">
                                <div class="form-check form-check-inline w-25">
                                    <input class="form-check-input" type="radio" name="business_scale" id="scale_50_100" value="50-100" required
                                           {{ old('business_scale') == '50-100' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="scale_50_100">50 - 100 người</label>
                                </div>
                                <div class="form-check form-check-inline w-25">
                                    <input class="form-check-input" type="radio" name="business_scale" id="scale_100_200" value="100-200" required
                                           {{ old('business_scale') == '100-200' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="scale_100_200">100 - 200 người</label>
                                </div>
                                <div class="form-check form-check-inline w-25">
                                    <input class="form-check-input" type="radio" name="business_scale" id="scale_200_500" value="200-500" required
                                           {{ old('business_scale') == '200-500' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="scale_200_500">200 - 500 người</label>
                                </div>
                                <div class="form-check form-check-inline w-25">
                                    <input class="form-check-input" type="radio" name="business_scale" id="scale_500" value="500+" required
                                           {{ old('business_scale') == '500+' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="scale_500">Trên 500 người</label>
                                </div>
                            </div>
                            @if ($errors->has('business_scale'))
                                <span class="text-danger ms-2">{{ $errors->first('business_scale') }}</span>
                            @endif
                        </div>

                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">6. Chứng chỉ và Giải thưởng</h3>
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <!-- Chứng chỉ -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="certificate_id" class="form-label mb-0 me-2" style="width: 250px;">Chứng chỉ</label>
                                <select id="certificate_id" name="certificate_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                    <option value="">-- Chọn chứng chỉ --</option>
                                    @foreach($certificates as $certificate)
                                        <option value="{{ $certificate->id }}" {{ old('certificate_id') == $certificate->id ? 'selected' : '' }}>
                                            {{ $certificate->certificate_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Giải thưởng -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="awards" class="form-label mb-0 me-2" style="width: 250px;">Giải thưởng</label>
                                <input id="awards" name="awards" type="text" 
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" value="{{ old('awards') }}"
                                placeholder="Nhập giải thưởng">
                            </div>

                            <!-- Bằng khen -->
                            <div class="d-flex align-items-center">
                                <label for="commendations" class="form-label mb-0 me-2" style="width: 250px;">Bằng khen, giấy khen</label>
                                <input id="commendations" name="commendations" type="text" 
                                class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" value="{{ old('commendations') }}"
                                placeholder="Nhập bằng khen, giấy khen">
                            </div>
                        </div>

                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">7. Lãnh đạo đơn vị</h3>
                        <!-- Lãnh đạo đơn vị -->
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <div>
                                <!-- Họ và tên -->
                                <div class="d-flex align-items-center mb-3">
                                    <label for="leader_name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" id="leader_name" name="leader_name" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                                       required placeholder="Nhập họ và tên" value="{{ old('leader_name') }}">
                                </div>

                                <!-- Chức vụ -->
                                <div class="d-flex align-items-center mb-3">
                                    <label for="leader_position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ <span class="text-danger">*</span></label>
                                    <input type="text" id="leader_position" name="leader_position" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                                       required placeholder="Nhập chức vụ" value="{{ old('leader_position') }}">
                                </div>

                                <!-- Số điện thoại -->
                                <div class="d-flex align-items-center mb-3">
                                    <label for="leader_phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" id="leader_phone" name="leader_phone" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                                       required placeholder="Nhập số điện thoại" value="{{ old('leader_phone') }}">
                                </div>
                                
                                <!-- Giới tính -->
                                <div class="d-flex align-items-center mb-3">
                                    <label class="form-label mb-0 me-1" style="width: 180px;">Giới tính <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="leader_gender" id="gender_male" value="male" required
                                            {{ old('leader_gender') == 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_male">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="leader_gender" id="gender_female" value="female" required
                                            {{ old('leader_gender') == 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_female">Nữ</label>
                                    </div>
                                </div>

                                <!-- Email liên hệ trực tiếp -->
                                <div class="d-flex align-items-center">
                                    <label for="leader_email" class="form-label mb-0 me-2" style="width: 250px;">Email liên hệ trực tiếp <span class="text-danger">*</span></label>
                                    <input type="email" id="leader_email" name="leader_email" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                                       required placeholder="Nhập email liên hệ" value="{{ old('leader_email') }}">
                                </div>
                            </div>
                        </div>

                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">8. Phụ trách kết nối</h3>
                        <!-- Thông tin phụ trách -->
                        <div class="border" style="padding: 20px; border-radius: 10px;" >
                            <div id="responsible_people">
                                <div class="d-flex align-items-center mb-3">
                                    <label for="name" class="form-label mb-0 me-2" style="width: 250px;">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="responsible_name[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                                        required placeholder="Nhập họ và tên" value="{{ old('responsible_name.0') }}">
                                </div>
    
                                <div class="d-flex align-items-center mb-3">
                                    <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ <span class="text-danger">*</span></label>
                                    <input type="text" id="position" name="responsible_position[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                                        required placeholder="Nhập chức vụ" value="{{ old('responsible_position.0') }}">
                                </div>
    
                                <div class="d-flex align-items-center mb-3">
                                    <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" id="phone" name="responsible_phone[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                                        required placeholder="Nhập số điện thoại" value="{{ old('responsible_phone.0') }}">
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <label class="form-label mb-0 me-1" style="width: 180px;">Giới tính <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="responsible_gender[0]" id="gender_male" value="male" required
                                                {{ old('responsible_gender.0') == 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_male">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="responsible_gender[0]" id="gender_female" value="female" required
                                                {{ old('responsible_gender.0') == 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_female">Nữ</label>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email liên hệ trực tiếp <span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="responsible_email[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" 
                                        required placeholder="Nhập email liên hệ" value="{{ old('responsible_email.0') }}">
                                </div>
                                
                                <hr class="my-4" style="border: 1px solid #FF7506;">
                                
                            </div>
                            <!-- Nút Thêm người phụ trách -->
                            <div class="d-flex justify-content-end mb-2">
                                <button type="button" class="btn btn-outline-primary" onclick="addResponsiblePerson()">Thêm người phụ trách</button>
                            </div>
                        </div>
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">9. Câu lạc bộ</h3>
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <div class="d-flex align-items-center">
                                <label for="club_id" class="form-label mb-0 me-2" style="width: 250px;">Câu lạc bộ</label>
                                <select id="club_id" name="club_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1">
                                    <option value="">-- Chọn câu lạc bộ --</option>
                                    @foreach($clubs as $club)
                                        <option value="{{ $club->id }}" {{ old('club_id') == $club->id ? 'selected' : '' }}>
                                            {{ $club->name_vi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Nút Lưu và Hủy -->
                    <div class="d-flex justify-content-center gap-3">
                        <x-cancel-button :route="route('business_customer.index')">
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

