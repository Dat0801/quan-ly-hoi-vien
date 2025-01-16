<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;

class ClubIndividualPartnerController extends Controller
{
    //
    public function index(Request $request, Club $club)
    {
        $search = $request->input('search');
        $partnerCategory = $request->input('partner_category');

        $partners = $club->individualPartners()
            ->when($search, function ($query, $search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('login_code', 'like', "%{$search}%")
                    ->orWhere('card_code', 'like', "%{$search}%");
            })
            ->when($partnerCategory, function ($query, $partnerCategory) {
                return $query->where('partner_category', $partnerCategory);
            })
            ->paginate(10);

        return view('club.individual_partner.index', compact('club', 'partners', 'search', 'partnerCategory'));
    }

}
