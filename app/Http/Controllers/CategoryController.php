<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;
use App\Models\Field;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('category.index');
    }

    public function loadIndustries(Request $request)
    {
        $industries = Industry::paginate(perPage: 1);

        if ($request->ajax()) {
            return view('category.industry.partial.index', compact('industries'))->render();
        }

        return view('category.index', compact('industries'));
    }

    public function loadFields(Request $request)
    {
        $fields = Field::paginate(1);

        if ($request->ajax()) {
            return view('category.field.partial.index', compact('fields'))->render();
        }

        return view('category.index', compact('fields'));
    }
}
