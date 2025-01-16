<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessPartner;
use App\Models\Club;

class ClubBusinessPartnerController extends Controller
{
    //
    public function index(Request $request, Club $club)
    {
        $search = $request->input('search');
        $partnerCategory = $request->input('partner_category');
        $groupId = $request->input('group_id'); // Add group filter if needed

        $businessPartners = $club->businessPartners()  // Get business partners related to the club
            ->when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('business_name_vi', 'like', "%{$search}%")
                        ->orWhere('business_name_en', 'like', "%{$search}%")
                        ->orWhere('login_code', 'like', "%{$search}%")
                        ->orWhere('card_code', 'like', "%{$search}%");
                });
            })
            ->when($partnerCategory, function ($query, $partnerCategory) {
                return $query->where('partner_category', $partnerCategory);
            })
            ->when($groupId, function ($query, $groupId) {
                return $query->where('group_id', $groupId); // Filter by group_id if needed
            })
            ->paginate(10);

        return view('club.business_partner.index', [
            'club' => $club,
            'businessPartners' => $businessPartners,
            'search' => $search,
            'partnerCategory' => $partnerCategory,
        ]);
    }
}
