<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Industry;
use App\Models\SubGroup;

class FieldController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $industryId = $request->input('industry_id');

        $industries = Industry::all();

        $fields = Field::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
        ->when($industryId, function($query, $industryId) {
            return $query->where('industry_id', $industryId);
        })->paginate(5);

        return view('category.field.index', compact('fields', 'industries', 'search', 'industryId'));
    }

    // Trang tạo mới lĩnh vực
    public function create()
    {
        $industries = Industry::all(); // Lấy tất cả các ngành
        return view('category.field.create', compact('industries'));
    }

    // Lưu lĩnh vực và nhóm con
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:fields',
            'description' => 'nullable',
            'industry_id' => 'required',
            'sub_groups' => 'nullable|array',
            'sub_groups.*.name' => 'required|string', // Tên nhóm con bắt buộc
            'sub_groups.*.description' => 'nullable|string', // Mô tả nhóm con tùy chọn
        ]);

        // Tạo lĩnh vực mới
        $field = Field::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'industry_id' => $request->industry_id,
        ]);

        // Tạo nhóm con nếu có
        if ($request->has('sub_groups')) {
            foreach ($request->sub_groups as $sub_group_data) {
                SubGroup::create([
                    'name' => $sub_group_data['name'],
                    'description' => $sub_group_data['description'], // Lưu mô tả nhóm con
                    'field_id' => $field->id,
                ]);
            }
        }

        return redirect()->route('field.index', ['tab' => 'fields'])
                 ->with('success', 'Thêm lĩnh vực thành công!');
    }

    // Xóa nhóm con
    public function destroySubGroup($id)
    {
        $subGroup = SubGroup::findOrFail($id);
        $subGroup->delete();
        return back();
    }

    public function destroy($id)
    {
        // Tìm lĩnh vực cần xóa
        $field = Field::findOrFail($id);

        // Xóa tất cả các nhóm con liên kết với lĩnh vực này
        foreach ($field->subGroups as $subGroup) {
            $subGroup->delete();  // Xóa từng nhóm con
        }

        // Xóa lĩnh vực
        $field->delete();

        // Redirect về trang danh sách với thông báo thành công
        return redirect()->route('field.index' , ['tab' => 'fields'])
        ->with('success', 'Lĩnh vực và các nhóm con đã được xóa thành công!');
    }
}
