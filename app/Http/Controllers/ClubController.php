<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Field;
use App\Models\Market;
use App\Models\Industry;
use App\Models\Connector;

class ClubController extends Controller
{
    //
    public function index(Request $request)
    {
        // Lấy danh sách lĩnh vực và thị trường để hiển thị trong form lọc
        $fields = Field::all();
        $markets = Market::all();

        // Query cơ bản
        $query = Club::query();

        // Lọc theo lĩnh vực
        if ($request->filled('field_id')) {
            $query->where('field_id', $request->field_id);
        }

        // Lọc theo thị trường
        if ($request->filled('market_id')) {
            $query->where('market_id', $request->market_id);
        }

        // Tìm kiếm theo tên
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_vi', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%");
            });
        }

        $clubs = $query->paginate(3);

        return view('club.index', compact('clubs', 'fields', 'markets'));
    }

    public function create()
    {
        $industries = Industry::all(); // Lấy tất cả ngành
        $fields = Field::all(); // Lấy tất cả lĩnh vực
        $markets = Market::all(); // Lấy tất cả thị trường
        return view('club.create', compact('industries', 'fields', 'markets'));
    }

    // Lưu câu lạc bộ mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'club_code' => 'required|unique:clubs,club_code',
            'name_vi' => 'required|string',
            'name_en' => 'nullable|string',
            'name_abbr' => 'nullable|string',
            'address' => 'nullable|string',
            'tax_code' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|string',
            'fanpage' => 'nullable|string',
            'established_date' => 'nullable|date',
            'established_decision' => 'nullable|string',
            'industry_id' => 'required|exists:industries,id',
            'field_id' => 'required|exists:fields,id',
            'market_id' => 'required|exists:markets,id',
            'responsible_name.*' => 'nullable|string',
            'responsible_position.*' => 'nullable|string',
            'responsible_phone.*' => 'nullable|string',
            'responsible_gender.*' => 'nullable|in:male,female',
            'responsible_email.*' => 'nullable|email',
        ]);

        // Tạo câu lạc bộ
        $club = Club::create([
            'club_code' => $request->club_code,
            'name_vi' => $request->name_vi,
            'name_en' => $request->name_en,
            'name_abbr' => $request->name_abbr,
            'address' => $request->address,
            'tax_code' => $request->tax_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'fanpage' => $request->fanpage,
            'established_date' => $request->established_date,
            'established_decision' => $request->established_decision,
            'industry_id' => $request->industry_id,
            'field_id' => $request->field_id,
            'market_id' => $request->market_id,
        ]);

        if ($request->has('responsible_name') && count($request->responsible_name) > 0) {
            $connectors = [];
            foreach ($request->responsible_name as $index => $name) {
                if (!empty($name)) { // Kiểm tra xem người phụ trách có thông tin không
                    $connectors[] = [
                        'club_id' => $club->id,
                        'name' => $name,
                        'position' => $request->responsible_position[$index] ?? null,
                        'phone' => $request->responsible_phone[$index] ?? null,
                        'gender' => $request->responsible_gender[$index] ?? null,
                        'email' => $request->responsible_email[$index] ?? null,
                    ];
                }
            }
    
            // Nếu có thông tin người phụ trách, lưu vào bảng connectors
            if (!empty($connectors)) {
                Connector::insert($connectors);
            }
        }
       
        // Chuyển hướng về trang danh sách câu lạc bộ và thông báo thành công
        return redirect()->route('club.index')->with('success', 'Câu lạc bộ được tạo thành công.');
    }


    public function show(Club $club)
    {
        return view('club.show', compact('club'));
    }

    public function edit(Club $club)
    {
        $industries = Industry::all();
        $fields = Field::all();
        $markets = Market::all();
        return view('club.edit', compact('club', 'industries', 'fields', 'markets'));
    }

    public function update(Request $request, Club $club)
    {
        // Validate the request data
        $validated = $request->validate([
            'club_code' => 'required|unique:clubs,club_code,' . $club->id,
            'name_vi' => 'required|string',
            'name_en' => 'nullable|string',
            'name_abbr' => 'nullable|string',
            'address' => 'nullable|string',
            'tax_code' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|string',
            'fanpage' => 'nullable|string',
            'established_date' => 'nullable|date',
            'established_decision' => 'nullable|string',
            'industry_id' => 'required|exists:industries,id',
            'field_id' => 'required|exists:fields,id',
            'market_id' => 'required|exists:markets,id',
            'responsible_name.*' => 'nullable|string',
            'responsible_position.*' => 'nullable|string',
            'responsible_phone.*' => 'nullable|string',
            'responsible_gender.*' => 'nullable|in:male,female',
            'responsible_email.*' => 'nullable|email',
        ]);

        // Update club details
        $club->update([
            'club_code' => $request->club_code,
            'name_vi' => $request->name_vi,
            'name_en' => $request->name_en,
            'name_abbr' => $request->name_abbr,
            'address' => $request->address,
            'tax_code' => $request->tax_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'fanpage' => $request->fanpage,
            'established_date' => $request->established_date,
            'established_decision' => $request->established_decision,
            'industry_id' => $request->industry_id,
            'field_id' => $request->field_id,
            'market_id' => $request->market_id,
        ]);

        // Handling responsible people (connectors)
        if ($request->has('responsible_name') && count($request->responsible_name) > 0) {
            // First, clear any existing connectors for the club
            $club->connector()->delete();

            // Prepare the connectors data
            $connectors = [];
            foreach ($request->responsible_name as $index => $name) {
                if (!empty($name)) { // Check if the responsible person has information
                    $connectors[] = [
                        'club_id' => $club->id,
                        'name' => $name,
                        'position' => $request->responsible_position[$index] ?? null,
                        'phone' => $request->responsible_phone[$index] ?? null,
                        'gender' => $request->responsible_gender[$index] ?? null,
                        'email' => $request->responsible_email[$index] ?? null,
                    ];
                }
            }

            // If there are valid connectors, insert them into the database
            if (!empty($connectors)) {
                Connector::insert($connectors);
            }
        }

        // Redirect to the club list page with a success message
        return redirect()->route('club.index')->with('success', 'Câu lạc bộ được cập nhật thành công.');
    }

    public function destroy(Club $club)
    {
        $club->delete();
        return redirect()->route('club.index')->with('success', 'Câu lạc bộ được xóa thành công.');
    }
}
