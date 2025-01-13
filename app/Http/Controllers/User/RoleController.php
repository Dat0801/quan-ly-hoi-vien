<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('user.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy('group_name');

        return view('user.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu từ form
        $validatedData = $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,role_name',
            'role_id' => 'required|string|max:255|unique:roles,role_id',
            'permissions' => 'array', 
        ], [
            'role_name.required' => 'Tên vai trò không được để trống.',
            'role_name.unique' => 'Tên vai trò đã tồn tại.',
            'role_id.required' => 'Mã vai trò không được để trống.',
            'role_id.unique' => 'Mã vai trò đã tồn tại.',
            'permissions.array' => 'Danh sách quyền không hợp lệ.',
        ]);

        try {
            $role = Role::create([
                'role_name' => $validatedData['role_name'],
                'role_id' => $validatedData['role_id'],
            ]);

            if (isset($validatedData['permissions']) && is_array($validatedData['permissions'])) {
                $existingPermissions = Permission::pluck('id')->toArray();
                $newPermissions = [];

                foreach ($validatedData['permissions'] as $permissionId) {
                    $groupID = explode('.', $permissionId)[0];
                    if (!in_array($permissionId, $existingPermissions)) {
                        $newPermission = Permission::create([
                            'permission_name' => "Chức năng $permissionId", 
                            'group_name' => "Nhóm chức năng $groupID" 
                        ]);
                        $newPermissions[] = $newPermission->id; 
                    } else {
                        $newPermissions[] = $permissionId; 
                    }
                }

                $role->permissions()->syncWithoutDetaching(array_merge($newPermissions, $validatedData['permissions']));
            }

            return redirect()->route('role.index')
                ->with('success', 'Vai trò và phân quyền đã được thêm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Đã xảy ra lỗi trong quá trình lưu vai trò: ' . $e->getMessage()])
                ->withInput();
        }
    }



    public function show($id)
    {
        $role = Role::with('permissions', 'users')->findOrFail($id);
        return view('role.show', compact('role'));
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();
        return view('role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,role_name,' . $id,
            'permissions' => 'array',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['role_name' => $validated['role_name']]);
        $role->permissions()->sync($request->permissions); // Cập nhật quyền

        return redirect()->route('role.index')->with('success', 'Role updated successfully!');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role deleted successfully!');
    }

}
