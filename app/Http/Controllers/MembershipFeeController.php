<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipFee;
use App\Models\BoardCustomer;
use App\Models\BusinessCustomer;
use App\Models\IndividualCustomer;
use App\Models\BusinessPartner;
use App\Models\IndividualPartner;

class MembershipFeeController extends Controller
{
    //
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status = $request->input('status');
        $search = $request->input('search');

        $query = MembershipFee::with('customer');

        if ($start_date && $end_date) {
            $query->whereBetween('payment_date', [$start_date, $end_date]);
        }

        if (!is_null($status)) {
            $query->where('status', $status);
        }

        $fees = $query->orderBy('year', 'desc')->paginate(6);

        return view('membership_fee.index', compact('fees'));
    }

    public function create()
    {
        $unpaidCustomerIds = MembershipFee::where('remaining_amount', '>', 0)
            ->pluck('customer_id')
            ->toArray();

        // Board Customers with club_id = null
        $boardCustomers = BoardCustomer::whereIn('id', $unpaidCustomerIds)
            ->whereNull('club_id')  // Điều kiện club_id là null
            ->select('id', 'full_name', 'phone')
            ->get()
            ->map(function ($customer) {
                $customer->type = BoardCustomer::class;
                return $customer;
            });

        // Business Customers with club_id = null
        $businessCustomers = BusinessCustomer::whereIn('id', $unpaidCustomerIds)
            ->whereNull('club_id')  // Điều kiện club_id là null
            ->select('id', 'business_name_vi as full_name', 'phone')
            ->get()
            ->map(function ($customer) {
                $customer->type = BusinessCustomer::class;
                return $customer;
            });

        // Individual Customers with club_id = null
        $individualCustomers = IndividualCustomer::whereIn('id', $unpaidCustomerIds)
            ->whereNull('club_id')  // Điều kiện club_id là null
            ->select('id', 'full_name', 'phone')
            ->get()
            ->map(function ($customer) {
                $customer->type = IndividualCustomer::class;
                return $customer;
            });

        // Business Partners with club_id = null
        $businessPartners = BusinessPartner::whereIn('id', $unpaidCustomerIds)
            ->whereNull('club_id')  // Điều kiện club_id là null
            ->select('id', 'business_name_vi as full_name', 'phone')
            ->get()
            ->map(function ($customer) {
                $customer->type = BusinessPartner::class;
                return $customer;
            });

        // Individual Partners with club_id = null
        $individualPartners = IndividualPartner::whereIn('id', $unpaidCustomerIds)
            ->whereNull('club_id')  // Điều kiện club_id là null
            ->select('id', 'full_name', 'phone')
            ->get()
            ->map(function ($customer) {
                $customer->type = IndividualPartner::class;
                return $customer;
            });

        $allCustomers = $boardCustomers
            ->concat($businessCustomers)
            ->concat($individualCustomers)
            ->concat($businessPartners)
            ->concat($individualPartners);

        $membershipFees = MembershipFee::where('remaining_amount', '>', 0)
            ->select('year', 'amount_due')
            ->distinct()
            ->get();

        return view('membership_fee.create', compact('allCustomers', 'membershipFees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'fee_date' => 'required|date',
            'content' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,txt|max:10240',
            'advance_payment_checkbox' => 'nullable|boolean',
            'years_count' => 'nullable|integer|min:1',
            'debt' => 'nullable|array',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $customer = MembershipFee::where('customer_id', $request->member_id)
            ->where('customer_type', $request->member_type) 
            ->first()
            ->customer;

        $customerType = get_class($customer);

        $debtYears = $request->input('debt', []);

        foreach ($debtYears as $year) {
            $membershipFee = MembershipFee::where('customer_id', $customer->id)
                ->where('year', $year)
                ->first();
            if (!$membershipFee) {
                $membershipFee = new MembershipFee();
                $membershipFee->customer_id = $customer->id;
                $membershipFee->customer_type = $customerType;
                $membershipFee->year = $year;
            }

            if (count($debtYears) > 1) {
                $amountPaid = $request->total_amount / count($debtYears);
            } else {
                $amountPaid = $request->total_amount;
            }

            $remainingAmount = $membershipFee->amount_due - $amountPaid;

            if ($remainingAmount <= 0) {
                $membershipFee->status = 1;
            } else {
                $membershipFee->status = 0;
            }

            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('attachments', 'public');
            }

            $membershipFee->amount_paid = $amountPaid;
            $membershipFee->remaining_amount = $remainingAmount;
            $membershipFee->content = $request->content;
            $membershipFee->attachment = $attachmentPath;
            $membershipFee->payment_date = $request->fee_date;
            $membershipFee->is_early_payment = $request->advance_payment_checkbox ?? false;
            $membershipFee->payment_years = $request->years_count ?? 0;

            $membershipFee->save();
        }

        return redirect()->route('membership_fee.index')->with('success', 'Hội phí đã được thêm hoặc cập nhật thành công.');
    }

}
