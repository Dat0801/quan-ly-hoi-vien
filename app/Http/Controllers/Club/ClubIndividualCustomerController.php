<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;

class ClubIndividualCustomerController extends Controller
{
    //
    public function index(Request $request, Club $club)
{
    $search = $request->input('search');
    $status = $request->input('status');

    $customers = $club->individualCustomers() 
        ->when($search, function ($query, $search) {
            return $query->where('full_name', 'like', "%{$search}%")
                ->orWhere('login_code', 'like', "%{$search}%")
                ->orWhere('card_code', 'like', "%{$search}%");
        })
        ->when($status, function ($query, $status) {
            if ($status == 'active') {
                return $query->where('status', 1);
            } elseif ($status == 'inactive') {
                return $query->where('status', 0);
            }
        })
        ->paginate(10);

    return view('club.individual_customer.index', compact('club', 'customers', 'search', 'status'));
}

}
