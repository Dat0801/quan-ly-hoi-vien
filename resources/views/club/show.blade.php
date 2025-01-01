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
            <h1 style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">Chi tiết câu lạc bộ</h1>

            <div class="row">
                <!-- Ô 1: Thông tin cơ bản -->
                <div class="col-lg-6">
                    <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">1. Thông tin cơ bản</h3>
                    <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                    
                        <!-- Mã câu lạc bộ -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="club_code" class="form-label mb-0 me-2" style="width: 250px;">Mã câu lạc bộ</label>
                            <input type="text" id="club_code" name="club_code" value="{{ $club->club_code ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <!-- Tên câu lạc bộ (Tiếng Việt) -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="name_vi" class="form-label mb-0 me-2" style="width: 250px;">Tên Tiếng Việt</label>
                            <input type="text" id="name_vi" name="name_vi" value="{{ $club->name_vi ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <!-- Tên câu lạc bộ (Tiếng Anh) -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="name_en" class="form-label mb-0 me-2" style="width: 250px;">Tên Tiếng Anh</label>
                            <input type="text" id="name_en" name="name_en" value="{{ $club->name_en ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <!-- Tên viết tắt -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="name_abbr" class="form-label mb-0 me-2" style="width: 250px;">Tên viết tắt</label>
                            <input type="text" id="name_abbr" name="name_abbr" value="{{ $club->name_abbr ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <!-- Địa chỉ -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="address" class="form-label mb-0 me-2" style="width: 250px;">Địa chỉ</label>
                            <input type="text" id="address" name="address" value="{{ $club->address ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <!-- Mã số thuế -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="tax_code" class="form-label mb-0 me-2" style="width: 250px;">Mã số thuế</label>
                            <input type="text" id="tax_code" name="tax_code" value="{{ $club->tax_code ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <!-- Số điện thoại -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                            <input type="text" id="phone" name="phone" value="{{ $club->phone ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <!-- Email -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email</label>
                            <input type="email" id="email" name="email" value="{{ $club->email ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <!-- Website -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="website" class="form-label mb-0 me-2" style="width: 250px;">Website</label>
                            <input type="text" id="website" name="website" value="{{ $club->website ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label for="fanpage" class="form-label mb-0 me-2" style="width: 250px;">Fanpage</label>
                            <input type="text" id="fanpage" name="fanpage" value="{{ $club->fanpage ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <!-- Ngày thành lập -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="established_date" class="form-label mb-0 me-2" style="width: 250px;">Ngày thành lập</label>
                            <input type="date" id="established_date" name="established_date" value="{{ $club->established_date ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>

                        <!-- Quyết định thành lập -->
                        <div class="d-flex align-items-center">
                            <label for="established_decision" class="form-label mb-0 me-2" style="width: 250px;">Quyết định thành lập</label>
                            <input type="text" id="established_decision" name="established_decision" value="{{ $club->established_decision ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                        </div>
                    </div>
                </div>

                <!-- Ô 2: Ngành - Lĩnh vực -->
                <div class="col-lg-6">
                    <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">2. Ngành - Lĩnh vực</h3>
                    <div class="mb-3">
                        <div class="border" style="padding: 20px; border-radius: 10px;">
                            <!-- Ngành -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="industry" class="form-label mb-0 me-2" style="width: 250px;">Ngành</label>
                                <input type="text" id="industry" name="industry" value="{{ $club->industry->industry_name ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                            </div>
                          
                            <!-- Lĩnh vực -->
                            <div class="d-flex align-items-center">
                                <label for="field_id" class="form-label mb-0 me-2" style="width: 250px;">Lĩnh vực</label>
                                <input type="text" id="field_id" name="field_id" value="{{ $club->field->name ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Thị trường -->
                    <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">3. Thị trường</h3>
                    <div class="border" style="padding: 20px; border-radius: 10px;">
                        <div class="d-flex align-items-center">
                            <label for="market" class="form-label mb-0 me-2" style="width: 250px;">Thị trường</label>
                            <input type="text" id="market" name="market" value="{{ $club->market->market_name ?? 'Không có thông tin' }}" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" disabled>
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
                                        <input type="text" id="name" name="responsible_name[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" value="{{ $person->name }}" disabled>
                                    </div>
                        
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="position" class="form-label mb-0 me-2" style="width: 250px;">Chức vụ</label>
                                        <input type="text" id="position" name="responsible_position[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" value="{{ $person->position }}" disabled>
                                    </div>
                        
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="phone" class="form-label mb-0 me-2" style="width: 250px;">Số điện thoại</label>
                                        <input type="text" id="phone" name="responsible_phone[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" value="{{ $person->phone }}" disabled>
                                    </div>
                        
                                    <div class="d-flex align-items-center mb-3">
                                        <label class="form-label mb-0 me-1" style="width: 180px;">Giới tính</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="responsible_gender[{{ $key }}]" id="gender_male_{{ $key }}" value="male" {{ old('responsible_gender.' . $key, $person->gender) == 'male' ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="gender_male_{{ $key }}">Nam</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="responsible_gender[{{ $key }}]" id="gender_female_{{ $key }}" value="female" {{ old('responsible_gender.' . $key, $person->gender) == 'female' ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="gender_female_{{ $key }}">Nữ</label>
                                        </div>
                                    </div>
                        
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="email" class="form-label mb-0 me-2" style="width: 250px;">Email liên hệ trực tiếp</label>
                                        <input type="email" id="email" name="responsible_email[]" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1" value="{{ $person->email }}" disabled>
                                    </div>
                        
                                    <hr class="my-4" style="border: 1px solid #FF7506;">
                                @endforeach
                            @else
                                <p>Không có thông tin người phụ trách kết nối.</p>
                            @endif
                        </div>
                        
                    </div>
                </div>

                <!-- Nút Quay lại -->
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('club.index') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Đóng</a>
                    <a href="{{ route('club.edit', $club->id) }}" class="btn btn-primary w-48 py-3 sm:rounded-lg" style="cursor: pointer;">
                        Chỉnh sửa
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
