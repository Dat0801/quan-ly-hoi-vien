<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IndustryRequest;
use App\Models\Industry;

class IndustryController extends Controller
{
    public function create()
    {
        return view('category.industry.create'); 
    }

    public function store(IndustryRequest $request)
    {
        Industry::create($request->all());
        return redirect()->route('category.index')->with('success', 'Thêm ngành thành công.');
    }

    public function show($id)
    {
        $industry = Industry::findOrFail($id);
        return view('category.industry.show', compact('industry'));
    }

    public function edit($id)
    {
        $industry = Industry::findOrFail($id);
        return view('category.industry.edit', compact('industry'));
    }

    public function update(IndustryRequest $request, $id)
    {
        $industry = Industry::findOrFail($id);
        $industry->update([
            'industry_code' => $request->industry_code,
            'industry_name' => $request->industry_name,
            'description' => $request->description,
        ]);

        return redirect()->route('category.index')->with('success', 'Cập nhật ngành thành công!');
    }


    public function destroy(Industry $industry)
    {
        $industry->delete();
        return redirect()->route('category.index')->with('success', 'Xóa ngành thành công.');
    }
}
