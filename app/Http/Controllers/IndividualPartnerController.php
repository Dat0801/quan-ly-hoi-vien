<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndividualPartner;
use App\Models\Industry;
use App\Models\Field;

class IndividualPartnerController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $partnerCategory = $request->input('partner_category');

        $partners = IndividualPartner::when($search, function ($query, $search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('login_code', 'like', "%{$search}%")
                    ->orWhere('card_code', 'like', "%{$search}%");
            })
            ->when($partnerCategory, function ($query, $partnerCategory) {
                return $query->where('partner_category', $partnerCategory);
            })
            ->paginate(10);

        return view('customer.individual_partner.index', compact('partners', 'search', 'partnerCategory'));
    }

    public function create()
    {
        $industries = Industry::all();
        $fields = Field::all();
        return view('customer.individual_partner.create', compact('industries', 'fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'login_code' => 'required|unique:individual_partners',
            'card_code' => 'nullable|unique:individual_partners',
            'full_name' => 'required',
            'phone' => 'required',
            'partner_category' => 'required|in:Việt Nam,Quốc tế',
            'unit' => 'nullable',
            'position' => 'nullable',
            'industry_id' => 'nullable|exists:industries,id',
            'field_id' => 'nullable|exists:fields,id',
            'club_id' => 'nullable|exists:clubs,id',
        ]);

        IndividualPartner::create($request->all());

        return redirect()->route('individual_partner.index')->with('success', 'Thêm đối tác thành công!');
    }

    public function show($id)
    {
        $partner = IndividualPartner::findOrFail($id);
        return view('customer.individual_partner.show', compact('partner'));
    }

    public function edit($id)
    {
        $industries = Industry::all();
        $fields = Field::all();
        $partner = IndividualPartner::findOrFail($id);
        return view('customer.individual_partner.edit', compact('partner', 'industries', 'fields'));
    }

    public function update(Request $request, $id)
    {
        $partner = IndividualPartner::findOrFail($id);

        $request->validate([
            'login_code' => 'required|unique:individual_partners,login_code,' . $id,
            'card_code' => 'required|unique:individual_partners,card_code,' . $id,
            'full_name' => 'required',
            'phone' => 'required',
            'partner_category' => 'required|in:Việt Nam,Quốc tế',
            'unit' => 'nullable',
            'position' => 'nullable',
            'industry_id' => 'nullable|exists:industries,id',
            'field_id' => 'nullable|exists:fields,id',
            'club_id' => 'nullable|exists:clubs,id',
        ]);

        $partner->update($request->all());

        return redirect()->route('individual_partner.index')->with('success', 'Cập nhật đối tác thành công!');
    }

    public function destroy($id)
    {
        $partner = IndividualPartner::findOrFail($id);
        $partner->delete();

        return redirect()->route('individual_partner.index')->with('success', 'Xóa đối tác thành công!');
    }
}