<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\BoardCustomer;
use App\Models\BusinessCustomer;
use App\Models\IndividualCustomer;
use App\Models\BusinessPartner;
use App\Models\IndividualPartner;

class ActivityController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->search;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $activities = Activity::with('participants')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'LIKE', "%$search%");
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('start_time', [$startDate, $endDate]);
            })
            ->paginate(10);

        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        $participantTypes = [
            BoardCustomer::class => 'Ban chấp hành',
            BusinessCustomer::class => 'Khách hàng doanh nghiệp',
            IndividualCustomer::class => 'Khách hàng cá nhân',
            BusinessPartner::class => 'Đối tác doanh nghiệp',
            IndividualPartner::class => 'Đối tác cá nhân',
        ];

        return view('activities.create', compact('participantTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'location' => 'required|string',
            'content' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:10240', 
            'participants' => 'required|array',
            'participants.*' => 'string',
            'external_participants' => 'nullable|array', 
            'external_participants.*.name' => 'nullable|string',
            'external_participants.*.email' => 'nullable|email',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $activity = Activity::create([
            'name' => $validated['name'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'location' => $validated['location'],
            'content' => $validated['content'], 
            'attachment' => $attachmentPath,    
        ]);

        if (in_array('all', $validated['participants'])) {
            $participantTypes = [
                BoardCustomer::class,
                BusinessCustomer::class,
                IndividualCustomer::class,
                BusinessPartner::class,
                IndividualPartner::class,
            ];

            foreach ($participantTypes as $type) {
                $activity->participants()->create([
                    'participantable_type' => $type,
                    'activity_id' => $activity->id,  
                ]);
            }
        } else {
            foreach ($validated['participants'] as $participantType) {
                $activity->participants()->create([
                    'participantable_type' => $participantType, 
                    'activity_id' => $activity->id,  
                ]);
            }
        }
        
        if (!empty($validated['external_participants'])) {
            foreach ($validated['external_participants'] as $externalParticipant) {
                $activity->participants()->create([
                    'activity_id' => $activity->id,
                    'external_name' => $externalParticipant['name'],
                    'external_email' => $externalParticipant['email'],
                    'participantable_type' => 'external',
                ]);
            }
        }
        

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    /**
     * Hiển thị thông tin chi tiết của hoạt động.
     */
    public function show($id)
    {
        $activity = Activity::with('participants.participantable')->findOrFail($id);
        return view('activities.show', compact('activity'));
    }

    /**
     * Xóa hoạt động.
     */
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Hoạt động đã được xóa thành công.');
    }
}
