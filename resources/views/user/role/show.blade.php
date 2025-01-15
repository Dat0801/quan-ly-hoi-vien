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
                Thông tin vai trò và phân quyền
            </h1>

            <form>
                @csrf
                <div class="row">
                    <!-- Phần 1: Thông tin vai trò -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; color: #803B03;">
                            1. Thông tin vai trò
                        </h3>
                        <div class="border mb-3" style="border-radius: 10px; padding: 20px;">
                            <!-- Tên vai trò -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="role_name" class="form-label mb-0 me-2" style="width: 250px;">Tên vai trò <span class="text-danger">*</span></label>
                                <input type="text" id="role_name" name="role_name" value="{{ $role->role_name }}" class="form-control border-gray-300 shadow-sm flex-grow-1" disabled>
                            </div>

                            <!-- Mã vai trò -->
                            <div class="d-flex align-items-center mb-3">
                                <label for="role_id" class="form-label mb-0 me-2" style="width: 250px;">Mã vai trò <span class="text-danger">*</span></label>
                                <input type="text" id="role_id" name="role_id" value="{{ $role->role_id }}" class="form-control border-gray-300 shadow-sm flex-grow-1" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Phần 2: Phân quyền -->
                    <div class="col-lg-6">
                        <h3 class="p-2" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 700; color: #803B03;">
                            2. Phân quyền
                        </h3>
                        <div class="permissions-container">
                            @foreach ($permissionsByGroup as $groupName => $groupPermissions)
                                <div class="border mb-3 permission-group" style="border-radius: 10px; padding: 20px;">
                                    <h4 class="mb-3">{{ $groupName }}</h4>
                                    
                                    <!-- Chọn tất cả cho từng nhóm -->
                                    <div class="form-check">
                                        <input class="form-check-input select-all-permissions" type="checkbox" id="select_all_{{ $groupName }}" 
                                        @if($groupPermissions->every(fn($permission) => in_array($permission->id, $role->permissions->pluck('id')->toArray()))) checked @endif disabled>
                                        <label class="form-check-label" for="select_all_{{ $groupName }}">
                                            Chọn tất cả
                                        </label>
                                    </div>

                                    <!-- Các checkbox quyền trong nhóm -->
                                    <div class="form-check">
                                        @foreach ($groupPermissions as $permission)
                                            <div>
                                                <input class="form-check-input permission-checkbox permission_{{ $groupName }}" type="checkbox" value="{{ $permission->id }}" id="permission_{{ $permission->id }}" 
                                                @if(in_array($permission->id, $role->permissions->pluck('id')->toArray())) checked @endif disabled>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ $permission->permission_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('role.index') }}" class="btn btn-outline-primary w-48 py-3 sm:rounded-lg">Đóng</a>
                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary w-48 py-3 sm:rounded-lg">Chỉnh sửa</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script để kiểm tra trạng thái của "Chọn tất cả"
        document.addEventListener('DOMContentLoaded', function() {
            const groups = document.querySelectorAll('.permission-group');

            groups.forEach((group) => {
                const checkboxes = group.querySelectorAll('.permission-checkbox');
                const selectAllCheckbox = group.querySelector('.select-all-permissions');

                selectAllCheckbox.checked = Array.from(checkboxes).every((checkbox) => checkbox.checked);

                checkboxes.forEach((checkbox) => {
                    checkbox.addEventListener('change', function() {
                        selectAllCheckbox.checked = Array.from(checkboxes).every((checkbox) => checkbox.checked);
                    });
                });

                selectAllCheckbox.addEventListener('change', function() {
                    if (!selectAllCheckbox.checked) {
                        checkboxes.forEach((checkbox) => {
                            checkbox.checked = false;
                        });
                    } else {
                        checkboxes.forEach((checkbox) => {
                            checkbox.checked = true;
                        });
                    }
                });
            });
        });
    </script>

</x-app-layout>
