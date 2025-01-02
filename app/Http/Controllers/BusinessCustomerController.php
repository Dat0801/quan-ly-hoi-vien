<?php

namespace App\Http\Controllers;

use App\Models\BusinessCustomer;
use App\Models\Certificate;
use App\Models\Club;
use App\Models\TargetCustomerGroup;
use App\Models\Market;
use App\Models\Field;
use App\Models\Industry;

use Illuminate\Http\Request;

class BusinessCustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $customers = BusinessCustomer::when($search, function ($query, $search) {
                return $query->where('business_name_vi', 'like', "%{$search}%")
                             ->orWhere('business_name_en', 'like', "%{$search}%")
                             ->orWhere('login_code', 'like', "%{$search}%")
                             ->orWhere('card_code', 'like', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                if ($status === 'active') {
                    return $query->where('status', 1);
                } elseif ($status === 'inactive') {
                    return $query->where('status', 0);
                }
            })
            ->paginate(10);

        return view('customer.business_customer.index', compact('customers', 'search', 'status'));
    }

    public function create()
    {
        $industries = Industry::all(); // Lấy tất cả ngành
        $fields = Field::all(); // Lấy tất cả lĩnh vực
        $markets = Market::all(); // Lấy tất cả thị trường
        $targetCustomerGroups = TargetCustomerGroup::all(); // Lấy tất cả thị trường
        $certificates = Certificate::all(); // Lấy tất cả thị trường
        $clubs = Club::all(); // Lấy tất cả thị trường
        return view('customer.business_customer.create',
         compact('industries', 'fields', 'markets', 'targetCustomerGroups', 'certificates', 'clubs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'login_code' => 'required|unique:business_customers',
            'card_code' => 'required|unique:business_customers',
            'business_name_vi' => 'required',
            'business_name_en' => 'nullable',
            'business_name_abbr' => 'nullable',
            'headquarters_address' => 'required',
            'branch_address' => 'nullable',
            'tax_code' => 'nullable',
            'phone' => 'required',
            'website' => 'nullable',
            'fanpage' => 'nullable',
            'established_date' => 'nullable|date',
            'established_decision' => 'nullable',
            'leader_name' => 'nullable|string',
            'leader_position' => 'nullable|string',
            'leader_phone' => 'nullable|string',
            'leader_gender' => 'nullable|string',
            'leader_email' => 'nullable|email',
            'charter_capital' => 'nullable|numeric',
            'pre_membership_revenue' => 'nullable|numeric',
            'email' => 'nullable|email',
            'industry_id' => 'nullable|exists:industries,id',
            'field_id' => 'nullable|exists:fields,id',
            'market_id' => 'nullable|exists:markets,id',
            'target_customer_group_id' => 'nullable|exists:target_customer_groups,id',
            'certificate_id' => 'nullable|exists:certificates,id',
            'club_id' => 'nullable|exists:clubs,id',
        ]);

        BusinessCustomer::create([
            'login_code' => $request->login_code,
            'card_code' => $request->card_code,
            'business_name_vi' => $request->business_name_vi,
            'business_name_en' => $request->business_name_en,
            'business_name_abbr' => $request->business_name_abbr,
            'headquarters_address' => $request->headquarters_address,
            'branch_address' => $request->branch_address,
            'tax_code' => $request->tax_code,
            'phone' => $request->phone,
            'website' => $request->website,
            'fanpage' => $request->fanpage,
            'established_date' => $request->established_date,
            'established_decision' => $request->established_decision,
            'leader_name' => $request->leader_name,
            'leader_position' => $request->leader_position,
            'leader_phone' => $request->leader_phone,
            'leader_gender' => $request->leader_gender,
            'leader_email' => $request->leader_email,
            'charter_capital' => $request->charter_capital,
            'pre_membership_revenue' => $request->pre_membership_revenue,
            'email' => $request->email,
            'industry_id' => $request->industry_id,
            'field_id' => $request->field_id,
            'market_id' => $request->market_id,
            'target_customer_group_id' => $request->target_customer_group_id,
            'certificate_id' => $request->certificate_id,
            'club_id' => $request->club_id,
        ]);

        return redirect()->route('business_customer.index')->with('success', 'Thêm khách hàng thành công!');
    }

    public function show($id)
    {
        $customer = BusinessCustomer::findOrFail($id);
        return view('customer.business_customer.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = BusinessCustomer::findOrFail($id);
        return view('customer.business_customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = BusinessCustomer::findOrFail($id);

        $request->validate([
            'login_code' => "required|unique:business_customers,login_code,{$id}",
            'card_code' => "required|unique:business_customers,card_code,{$id}",
            'business_name_vi' => 'required',
            'headquarters_address' => 'required',
            'phone' => 'required',
            'business_scale' => 'required|in:50-100,100-200,200-500,500+',
        ]);

        $customer->update($request->all());

        return redirect()->route('business_customer.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy($id)
    {
        $customer = BusinessCustomer::findOrFail($id);
        $customer->delete();

        return redirect()->route('business_customer.index')->with('success', 'Customer deleted successfully!');
    }
}
