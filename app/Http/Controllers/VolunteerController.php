<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\VolunteerParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $volunteers = Volunteer::orderBy('created_at', 'desc')->paginate(10);

        // Calculate overall statistics
        $totalVolunteers = Volunteer::count();
        $totalParticipants = VolunteerParticipant::count();
        $pendingParticipants = VolunteerParticipant::where('status', 'pending')->count();
        $acceptedParticipants = VolunteerParticipant::where('status', 'accepted')->count();

        return view('admin.volunteer.index', compact(
            'volunteers',
            'totalVolunteers',
            'totalParticipants',
            'pendingParticipants',
            'acceptedParticipants'
        ));
    }

    /**
     * Show the participants of a volunteer program.
     */
    public function participants($id)
    {
        $volunteer = Volunteer::findOrFail($id);

        // Get paginated participants for this volunteer
        $participants = VolunteerParticipant::where('volunteer_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Calculate statistics
        $totalParticipants = VolunteerParticipant::where('volunteer_id', $id)->count();
        $pendingCount = VolunteerParticipant::where('volunteer_id', $id)->where('status', 'pending')->count();
        $acceptedCount = VolunteerParticipant::where('volunteer_id', $id)->where('status', 'accepted')->count();
        $rejectedCount = VolunteerParticipant::where('volunteer_id', $id)->where('status', 'rejected')->count();

        return view('admin.volunteer.participants', compact(
            'volunteer',
            'participants',
            'totalParticipants',
            'pendingCount',
            'acceptedCount',
            'rejectedCount'
        ));
    }

    /**
     * Update participant status
     */
    public function updateParticipantStatus(Request $request, $volunteerId, $participantId)
    {
        $participant = VolunteerParticipant::where('volunteer_id', $volunteerId)
            ->where('id', $participantId)
            ->firstOrFail();

        $request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $participant->update(['status' => $request->status]);

        $message = 'Status participant berhasil diupdate ke ' . ucfirst($request->status);

        return redirect()->route('volunteer.participants', $volunteerId)
            ->with('success', $message);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.volunteer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'specification_1' => 'nullable|string|max:255',
            'specification_2' => 'nullable|string|max:255',
            'specification_3' => 'nullable|string|max:255',
            'specification_4' => 'nullable|string|max:255',
            'specification_5' => 'nullable|string|max:255',
            'specification_6' => 'nullable|string|max:255',
            'specification_7' => 'nullable|string|max:255',
            'specification_8' => 'nullable|string|max:255',
            'specification_9' => 'nullable|string|max:255',
            'specification_10' => 'nullable|string|max:255',
            'photo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pic_1' => 'required|string|max:255',
            'pic_2' => 'nullable|string|max:255',
            'phonenumber_1' => 'required|string|max:20',
            'phonenumber_2' => 'nullable|string|max:20',
            'link' => 'nullable|url|max:255',
            'status' => 'required|string',
        ]);

        // Handle file uploads
        if ($request->hasFile('photo_1')) {
            $validated['photo_1'] = $request->file('photo_1')->store('volunteers', 'public');
        }
        if ($request->hasFile('photo_2')) {
            $validated['photo_2'] = $request->file('photo_2')->store('volunteers', 'public');
        }
        if ($request->hasFile('photo_3')) {
            $validated['photo_3'] = $request->file('photo_3')->store('volunteers', 'public');
        }

        Volunteer::create($validated);

        return redirect()->route('volunteer.index')
            ->with('success', 'Volunteer program created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $volunteer = Volunteer::with('participants')->findOrFail($id);
        return view('admin.volunteer.show', compact('volunteer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $volunteer = Volunteer::findOrFail($id);
        return view('admin.volunteer.edit', compact('volunteer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $volunteer = Volunteer::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'specification_1' => 'nullable|string|max:255',
            'specification_2' => 'nullable|string|max:255',
            'specification_3' => 'nullable|string|max:255',
            'specification_4' => 'nullable|string|max:255',
            'specification_5' => 'nullable|string|max:255',
            'specification_6' => 'nullable|string|max:255',
            'specification_7' => 'nullable|string|max:255',
            'specification_8' => 'nullable|string|max:255',
            'specification_9' => 'nullable|string|max:255',
            'specification_10' => 'nullable|string|max:255',
            'photo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pic_1' => 'required|string|max:255',
            'pic_2' => 'nullable|string|max:255',
            'phonenumber_1' => 'required|string|max:20',
            'phonenumber_2' => 'nullable|string|max:20',
            'link' => 'nullable|url|max:255',
            'status' => 'required|string',
        ]);

        // Handle file uploads and delete old files
        if ($request->hasFile('photo_1')) {
            if ($volunteer->photo_1) {
                Storage::disk('public')->delete($volunteer->photo_1);
            }
            $validated['photo_1'] = $request->file('photo_1')->store('volunteers', 'public');
        }
        if ($request->hasFile('photo_2')) {
            if ($volunteer->photo_2) {
                Storage::disk('public')->delete($volunteer->photo_2);
            }
            $validated['photo_2'] = $request->file('photo_2')->store('volunteers', 'public');
        }
        if ($request->hasFile('photo_3')) {
            if ($volunteer->photo_3) {
                Storage::disk('public')->delete($volunteer->photo_3);
            }
            $validated['photo_3'] = $request->file('photo_3')->store('volunteers', 'public');
        }

        $volunteer->update($validated);

        return redirect()->route('volunteer.index')
            ->with('success', 'Volunteer program updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $volunteer = Volunteer::findOrFail($id);

        // Delete associated photos
        if ($volunteer->photo_1) {
            Storage::disk('public')->delete($volunteer->photo_1);
        }
        if ($volunteer->photo_2) {
            Storage::disk('public')->delete($volunteer->photo_2);
        }
        if ($volunteer->photo_3) {
            Storage::disk('public')->delete($volunteer->photo_3);
        }

        $volunteer->delete();

        return redirect()->route('volunteer.index')
            ->with('success', 'Volunteer program deleted successfully!');
    }

    /**
     * Export participants data as CSV
     */
    public function exportParticipants($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        $participants = VolunteerParticipant::where('volunteer_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'volunteer_participants_' . \Str::slug($volunteer->title) . '_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($participants) {
            $file = fopen('php://output', 'w');

            // CSV Header
            fputcsv($file, [
                'Name',
                'Address',
                'Phone Number',
                'Email',
                'Reason',
                'Experience',
                'Education',
                'Status',
                'Date Applied',
                'Time Applied'
            ]);

            // CSV Data
            foreach ($participants as $participant) {
                fputcsv($file, [
                    $participant->name,
                    $participant->adress,
                    $participant->phonenumber,
                    $participant->email,
                    $participant->reason ?? '',
                    $participant->experience ?? '',
                    $participant->last_education ?? '',
                    ucfirst($participant->status),
                    $participant->created_at->format('Y-m-d'),
                    $participant->created_at->format('H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}