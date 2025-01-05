<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Models\IndividualCustomer;
use App\Models\Industry;
use App\Models\Field;

class IndividualCustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $customers = IndividualCustomer::when($search, function ($query, $search) {
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

        return view('customer.individual_customer.index', compact('customers', 'search', 'status'));
    }

    public function create()
    {
        $industries = Industry::all(); // Lấy tất cả ngành
        $fields = Field::all(); // Lấy tất cả lĩnh vực
        return view('customer.individual_customer.create', compact('industries', 'fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'login_code' => 'required|unique:individual_customers',
            'card_code' => 'nullable|unique:individual_customers',
            'full_name' => 'required',
            'birth_date' => 'nullable|date',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:individual_customers',
            'unit' => 'nullable',
            'is_board_member' => 'required|boolean',
            'board_position' => 'nullable',
            'term' => 'nullable',
            'industry_id' => 'nullable|exists:industries,id',
            'field_id' => 'nullable|exists:fields,id',
            'club_id' => 'nullable|exists:clubs,id',
        ]);

        IndividualCustomer::create($request->all());

        return redirect()->route('individual_customer.index')->with('success', 'Thêm khách hàng thành công!');
    }

    public function show($id)
    {
        $customer = IndividualCustomer::findOrFail($id);
        return view('customer.individual_customer.show', compact('customer'));
    }

    public function edit($id)
    {
        $industries = Industry::all(); // Lấy tất cả ngành
        $fields = Field::all(); // Lấy tất cả lĩnh vực
        $customer = IndividualCustomer::findOrFail($id);
        return view('customer.individual_customer.edit', compact('customer', 'industries', 'fields'));
    }

    public function update(Request $request, $id)
    {
        $customer = IndividualCustomer::findOrFail($id);

        $request->validate([
            'login_code' => 'required|unique:individual_customers,login_code,' . $id,
            'card_code' => 'required|unique:individual_customers,card_code,' . $id,
            'full_name' => 'required',
            'birth_date' => 'nullable|date',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:individual_customers,email,' . $id,
            'unit' => 'nullable',
            'is_board_member' => 'required|boolean',
            'board_position' => 'nullable',
            'term' => 'nullable',
            'industry_id' => 'nullable|exists:industries,id',
            'field_id' => 'nullable|exists:fields,id',
            'club_id' => 'nullable|exists:clubs,id',
        ]);

        $customer->update($request->all());

        return redirect()->route('individual_customer.index')->with('success', 'Cập nhật khách hàng thành công!');
    }

    public function destroy($id)
    {
        $customer = IndividualCustomer::findOrFail($id);
        $customer->delete();

        return redirect()->route('individual_customer.index')->with('success', 'Xóa khách hàng thành công!');
    }

    public function sponsorshipHistory($customerId, Request $request)
    {
        $customer = IndividualCustomer::findOrFail($customerId);

        $sponsorships = Sponsorship::where('sponsorable_id', $customerId)
            ->where('sponsorable_type', IndividualCustomer::class)
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                return $query->whereBetween('sponsorship_date', [$request->start_date, $request->end_date]);
            })
            ->when($request->search, function ($query) use ($request) {
                return $query->where('product', 'LIKE', "%{$request->search}%");
            })
            ->get();
        $totalContribution = $sponsorships->sum('total_amount');
        return view('customer.business_customer.sponsorship_history', compact('customer', 'sponsorships', 'totalContribution'));
    }
}
