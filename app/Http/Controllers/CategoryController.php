<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;
use App\Models\Field;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('category.index');
    }

    public function loadIndustries(Request $request)
    {
        $search = $request->input('search'); 
        $industries = Industry::when($search, function ($query, $search) {
            return $query->where('industry_name', 'LIKE', '%' . $search . '%');
        })->paginate(5); 

        if ($request->ajax()) {
            return view('category.industry.partial.index', compact('industries'))->render();
        }
        return view('category.index', compact('industries'));
    }

    public function loadFields(Request $request)
    {
        $search = $request->input('search');

        $fields = Field::when($search, function ($query, $search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        if ($request->ajax()) {
            return view('category.field.partial.index', compact('fields'))->render();
        }

        return view('category.index', compact('fields'));
    }

}
