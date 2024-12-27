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
            <h1 class="mb-4" style="
                font-family: 'Roboto', sans-serif;
                font-size: 32px;
                font-weight: 700;
                line-height: 38.4px;
                color: #803B03;">Thêm lĩnh vực
            </h1>

            <form action="{{ route('field.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Tên lĩnh vực -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Tên lĩnh vực</label>
                        <input type="text" id="name" name="name" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="industry" class="form-label">Ngành</label>
                        <select id="industry" name="industry_id" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" required>
                            @foreach($industries as $industry)
                                <option value="{{ $industry->id }}">{{ $industry->industry_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Mã lĩnh vực nằm dưới tên lĩnh vực -->
                    <div class="col-md-6 mb-3">
                        <label for="code" class="form-label">Mã lĩnh vực</label>
                        <input type="text" id="code" name="code" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500" required>
                    </div>

                    <!-- Mô tả và Ngành -->
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea id="description" name="description" rows="3" class="form-control border-gray-300 shadow-sm focus:ring-indigo-500"></textarea>
                    </div>
                </div>

                <!-- Nhóm con dạng lưới -->
                <div id="sub_groups" class="row mb-3">
                    <label class="form-label">Nhóm con</label>
                    <div class="col-md-4 mb-3">
                        <input type="text" name="sub_groups[0][name]" placeholder="Tên nhóm con" class="form-control mb-2" required>
                        <textarea name="sub_groups[0][description]" placeholder="Mô tả nhóm con" class="form-control mb-2"></textarea>
                    </div>
                </div>

                <!-- Nút Thêm nhóm con ở góc phải -->
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-outline-secondary" onclick="addSubGroup()">Thêm nhóm con</button>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('category.index') }}?tab={{ request()->get('tab', 'fields') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Hủy</a>
                    <button type="submit" class="btn btn-primary w-48 py-3 sm:rounded-lg">Thêm lĩnh vực</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    function addSubGroup() {
        const subGroupsRow = document.getElementById('sub_groups');
        const newIndex = subGroupsRow.querySelectorAll('.col-md-4').length;

        const newCol = document.createElement('div');
        newCol.className = 'col-md-4 mb-3';
        newCol.innerHTML = `
            <input type="text" name="sub_groups[${newIndex}][name]" placeholder="Tên nhóm con" class="form-control mb-2" required>
            <textarea name="sub_groups[${newIndex}][description]" placeholder="Mô tả nhóm con" class="form-control mb-2"></textarea>
            <button type="button" class="btn btn-outline-danger w-100" onclick="removeSubGroup(this)">Xóa nhóm</button>
        `;
        subGroupsRow.appendChild(newCol);
    }

    function removeSubGroup(button) {
        button.closest('.col-md-4').remove();
    }
</script>
