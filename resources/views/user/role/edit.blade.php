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
                Chỉnh sửa vai trò và phân quyền</h1>

            <form action="{{ route('role.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Phần 1: Thông tin vai trò -->
                    <div class="col-lg-6">
                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            1. Thông tin vai trò</h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Tên vai trò -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="role_name" class="form-label mb-0 me-2" style="width: 250px;">Tên vai trò
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="role_name" name="role_name" value="{{ old('role_name', $role->role_name) }}"
                                    placeholder="Nhập tên vai trò"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('role_name'))
                                    <span class="text-danger ms-2">{{ $errors->first('role_name') }}</span>
                                @endif
                            </div>

                            <!-- Mã vai trò -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="role_id" class="form-label mb-0 me-2" style="width: 250px;">Mã vai trò
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="role_id" name="role_id" value="{{ old('role_id', $role->role_id) }}"
                                    placeholder="Nhập mã vai trò"
                                    class="form-control border-gray-300 shadow-sm focus:ring-indigo-500 flex-grow-1"
                                    required>
                                @if ($errors->has('role_id'))
                                    <span class="text-danger ms-2">{{ $errors->first('role_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Phần 2: Phân quyền -->
                    <div class="col-lg-6">
                        <h3 class="p-2"
                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; line-height: 38.4px; color: #803B03;">
                            2. Phân quyền</h3>
                        <div class="permissions-container">
                            @foreach ($permissions as $groupName => $groupPermissions)
                                <div class="border mb-3 permission-group" style="border-radius: 10px; padding: 20px;">
                                    <h4 class="mb-3">{{ $groupName }}</h4>
                                    <div class="form-check">
                                        <input class="form-check-input select-all" type="checkbox"
                                            id="selectAll_{{ $groupName }}">
                                        <label class="form-check-label" for="selectAll_{{ $groupName }}">Chọn tất
                                            cả</label>
                                    </div>
                                    <div class="form-check">
                                        @foreach ($groupPermissions as $permission)
                                            <div>
                                                <input class="form-check-input permission-checkbox" type="checkbox"
                                                    name="permissions[]" value="{{ $permission->id }}"
                                                    id="permission_{{ $permission->id }}"
                                                    {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ $permission->permission_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg"
                            id="addPermissionGroup">
                            Thêm nhóm chức năng
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <x-cancel-button :route="route('role.index')">
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

<script>
    document.getElementById('addPermissionGroup').addEventListener('click', function() {
        const groupCount = document.querySelectorAll('.permission-group').length + 1;

        const newGroup = document.createElement('div');
        newGroup.classList.add('border', 'mb-3', 'permission-group');
        newGroup.style.borderRadius = '10px';
        newGroup.style.padding = '20px';

        const groupHTML = `
        <h4>Nhóm chức năng ${groupCount}</h4>
        <div class="form-check">
            <input class="form-check-input select-all" type="checkbox" id="selectAllGroup${groupCount}">
            <label class="form-check-label" for="selectAllGroup${groupCount}">Chọn tất cả</label>
        </div>
        <div class="form-check">
            ${generatePermissionsHTML(groupCount)}
        </div>
    `;

        newGroup.innerHTML = groupHTML;
        document.querySelector('.permissions-container').appendChild(newGroup);

        addCheckboxEventListeners(newGroup);
    });

    function generatePermissionsHTML(groupCount) {
        let permissionsHTML = '';
        for (let i = 1; i <= 4; i++) {
            const permissionNumber = `${groupCount}.${i}`;
            permissionsHTML += `
            <div>
                <input class="form-check-input permission-checkbox" type="checkbox" 
                    name="permissions[]" value="${permissionNumber}" 
                    id="permission_${permissionNumber}">
                <label class="form-check-label" for="permission_${permissionNumber}">Chức năng ${permissionNumber}</label>
            </div>
        `;
        }
        return permissionsHTML;
    }

    function addCheckboxEventListeners(groupElement) {
        const selectAllCheckbox = groupElement.querySelector('.select-all');
        const individualCheckboxes = groupElement.querySelectorAll('.permission-checkbox');

        selectAllCheckbox.addEventListener('change', function() {
            individualCheckboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
        });

        individualCheckboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const allChecked = Array.from(individualCheckboxes).every(cb => cb.checked);
                selectAllCheckbox.checked = allChecked;
            });
        });

        const allChecked = Array.from(individualCheckboxes).every(cb => cb.checked);
        selectAllCheckbox.checked = allChecked;
    }

    document.querySelectorAll('.permission-group').forEach(groupElement => {
        addCheckboxEventListeners(groupElement); 
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('select-all')) {
            const checkboxes = e.target.closest('.permission-group').querySelectorAll('.permission-checkbox');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        }
    });
</script>
