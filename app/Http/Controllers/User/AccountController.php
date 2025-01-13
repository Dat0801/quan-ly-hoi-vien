<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function index(Request $request)
    {
        $status = $request->get('status');
        $role_id = $request->get('role_id');
        $search = $request->get('search');

        $roles = Role::all();

        $accounts = User::query()
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($role_id, function ($query) use ($role_id) {
                return $query->where('role_id', $role_id);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone_number', 'like', '%' . $search . '%');
                });
            })
            ->with('role') 
            ->paginate(10); 

        return view('user.account.index', compact('accounts', 'roles'));
    }

    /**
     * Hiển thị chi tiết một tài khoản.
     */
    public function show($id)
    {
        $account = User::with('role')->findOrFail($id);

        return view('user.account.show', compact('account'));
    }

    /**
     * Hiển thị form tạo tài khoản mới.
     */
    public function create()
    {
        $roles = Role::all();

        return view('user.account.create', compact('roles'));
    }

    /**
     * Lưu tài khoản mới.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:15',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|boolean',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('account.index')->with('success', 'Tài khoản đã được tạo thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa tài khoản.
     */
    public function edit($id)
    {
        $account = User::findOrFail($id);
        $roles = Role::all();

        return view('user.account.edit', compact('account', 'roles'));
    }

    /**
     * Cập nhật tài khoản.
     */
    public function update(Request $request, $id)
    {
        $account = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $account->id,
            'phone_number' => 'nullable|string|max:15',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|boolean',
        ]);

        $account->update($validatedData);

        return redirect()->route('account.index')->with('success', 'Tài khoản đã được cập nhật thành công.');
    }

    /**
     * Xóa tài khoản.
     */
    public function destroy($id)
    {
        $account = User::findOrFail($id);

        $account->delete();

        return redirect()->route('account.index')->with('success', 'Tài khoản đã được xóa thành công.');
    }
}
