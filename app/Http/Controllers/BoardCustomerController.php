<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardCustomer;

class BoardCustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // Lấy tham số 'status' từ request

        $customers = BoardCustomer::when($search, function ($query, $search) {
                return $query->where('full_name', 'like', "%{$search}%")
                            ->orWhere('login_code', 'like', "%{$search}%")
                            ->orWhere('card_code', 'like', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                // Lọc theo status nếu có
                if ($status == 'active') {
                    return $query->where('status', 1); // Đang hoạt động
                } elseif ($status == 'inactive') {
                    return $query->where('status', 0); // Ngưng hoạt động
                }
            })
            ->paginate(10);

        return view('customer.board_customer.index', compact('customers', 'search', 'status'));
    }

    public function create()
    {
        return view('customer.board_customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login_code' => 'required|unique:board_customers',
            'card_code' => 'required|unique:board_customers',
            'full_name' => 'required',
            'birth_date' => 'nullable|date',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'unit_name' => 'required',
            'unit_position' => 'required',
            'association_position' => 'required',
            'term' => 'required',
            'attendance_permission' => 'nullable|in:1,0', 
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName();
            $uniqueFileName = uniqid() . '_' . $fileName;
            $avatarPath = $file->storeAs('avatars', $uniqueFileName, 'public');
        }

        $attendancePermission = $request->attendance_permission == '1' ? true : false;

        BoardCustomer::create([
            'login_code' => $request->login_code,
            'card_code' => $request->card_code,
            'full_name' => $request->full_name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'avatar' => $avatarPath,
            'unit_name' => $request->unit_name,
            'unit_position' => $request->unit_position,
            'association_position' => $request->association_position,
            'term' => $request->term,
            'attendance_permission' => $attendancePermission,
            'status' => true,
        ]);

        return redirect()->route('board_customer.index')->with('success', 'Thêm ban chấp hành thành công!');
    }

    public function show($id)
    {
        $customer = BoardCustomer::findOrFail($id);
        return view('customer.board_customer.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = BoardCustomer::findOrFail($id);
        return view('customer.board_customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = BoardCustomer::findOrFail($id);

        $request->validate([
            'full_name' => 'required',
            'birth_date' => 'nullable|date',
            'gender' => 'required',
            'phone' => 'required',
            'unit_name' => 'required',
            'unit_position' => 'required',
            'association_position' => 'required',
            'term' => 'required',
            'attendance_permission' => 'boolean',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($customer->avatar) {
                $oldAvatarPath = public_path('storage/' . $customer->avatar); 
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath); 
                }
            }

            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName(); 
            $uniqueFileName = uniqid() . '_' . $fileName;
            $avatarPath = $file->storeAs('avatars', $uniqueFileName, 'public'); 
            $customer->avatar = $avatarPath;
        }

        $customer->update($request->except('avatar')); 

        return redirect()->route('board_customer.index')->with('success', 'Cập nhật ban chấp hành thành công!');
    }

    public function destroy($id)
    {
        $customer = BoardCustomer::findOrFail($id);
        $customer->delete();

        return redirect()->route('board_customer.index')->with('success', 'Xóa ban chấp hành thành công!');
    }
}
