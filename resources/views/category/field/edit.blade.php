<x-app-layout :hideSidebar="true">
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
        <div class="p-4 bg-white shadow-sm rounded-lg w-100" style="max-height: 80vh; overflow-y: auto;">
            <h1 class="mb-4" style="font-family: 'Roboto', sans-serif; font-size: 32px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                Chỉnh sửa lĩnh vực
            </h1>

            <!-- Form Edit -->
            <form action="{{ route('field.update', $field->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Tên lĩnh vực -->
                    <div class="col-md-6 mb-3">
                        <label for="name_edit" class="form-label">Tên lĩnh vực</label>
                        <input type="text" id="name_edit" name="name" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" value="{{ $field->name }}" required>
                    </div>

                    <!-- Ngành -->
                    <div class="col-md-6 mb-3">
                        <label for="industry_edit" class="form-label">Ngành</label>
                        <select id="industry_edit" name="industry_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" required>
                            @foreach($industries as $industry)
                                <option value="{{ $industry->id }}" {{ $field->industry_id == $industry->id ? 'selected' : '' }}>
                                    {{ $industry->industry_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Mã lĩnh vực -->
                    <div class="col-md-6 mb-3">
                        <label for="code_edit" class="form-label">Mã lĩnh vực</label>
                        <input type="text" id="code_edit" name="code" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" value="{{ $field->code }}" required>
                    </div>

                    <!-- Mô tả -->
                    <div class="col-md-6 mb-3">
                        <label for="description_edit" class="form-label">Mô tả</label>
                        <textarea id="description_edit" name="description" rows="3" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500">{{ $field->description }}</textarea>
                    </div>
                </div>

                <!-- Nhóm con -->
                <div id="sub_groups" class="row mb-3">
                    <label class="form-label">Nhóm con</label>
                    @foreach($field->subGroups as $key => $subGroup)
                        <div class="col-md-4 mb-3">
                            <input type="hidden" name="sub_groups[{{ $key }}][id]" value="{{ $subGroup->id }}">
                            <input type="text" name="sub_groups[{{ $key }}][name]" class="form-control mb-2" value="{{ $subGroup->name }}" required>
                            <textarea name="sub_groups[{{ $key }}][description]" class="form-control mb-2">{{ $subGroup->description }}</textarea>
                            <button type="button" class="btn btn-outline-danger w-100" onclick="removeSubGroup(this)">Xóa nhóm</button>
                        </div>
                    @endforeach
                </div>

                <!-- Nút Thêm nhóm con -->
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-outline-secondary" onclick="addSubGroup()">Thêm nhóm con</button>
                </div>

                <!-- Nút hành động -->
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('field.show', $field->id) }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Quay lại</a>
                    <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        initializeSubGroupIndex({{ $field->subGroups->count() }}); // Khởi tạo với số lượng nhóm con hiện tại
    });
</script>

