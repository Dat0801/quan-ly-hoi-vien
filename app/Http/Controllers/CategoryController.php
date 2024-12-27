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
        return redirect()->route('industry.index');
    }

}
