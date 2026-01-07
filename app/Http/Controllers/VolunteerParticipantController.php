<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\VolunteerParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VolunteerParticipantController extends Controller
{
    /**
     * Display a listing of volunteer programs
     */
    public function index()
    {
        $volunteers = Volunteer::where('status', 'active')
            ->where('date', '>=', now()->subDays(30))
            ->orderBy('date', 'asc')
            ->with('participants')
            ->paginate(9);

        return view('volunteers.index', compact('volunteers'));
    }

    /**
     * Show the volunteer detail page
     */
    public function show($id)
    {
        $volunteer = Volunteer::with('participants')->findOrFail($id);

        // Calculate participant statistics
        $totalParticipants = $volunteer->participants->count();
        $acceptedParticipants = $volunteer->participants->where('status', 'accepted')->count();
        $pendingParticipants = $volunteer->participants->where('status', 'pending')->count();
        $rejectedParticipants = $volunteer->participants->where('status', 'rejected')->count();

        // Get recent participants
        $recentParticipants = $volunteer->participants()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Get related volunteers (upcoming programs)
        $relatedVolunteers = Volunteer::where('id', '!=', $id)
            ->where('status', 'active')
            ->where('date', '>=', now())
            ->take(3)
            ->get();

        // Collect all specifications
        $specifications = [];
        for ($i = 1; $i <= 10; $i++) {
            $spec = $volunteer->{'specification_' . $i};
            if (!empty($spec)) {
                $specifications[] = $spec;
            }
        }

        return view('volunteers.show', compact(
            'volunteer',
            'totalParticipants',
            'acceptedParticipants',
            'pendingParticipants',
            'rejectedParticipants',
            'recentParticipants',
            'relatedVolunteers',
            'specifications'
        ));
    }

    /**
     * Store a new volunteer participant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'volunteer_id' => 'required|exists:volunteer,id',
            'name' => 'required|string|max:255',
            'adress' => 'required|string|max:500',
            'phonenumber' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'reason' => 'required|string|max:1000',
            'experience' => 'nullable|string|max:1000',
            'last_education' => 'required|string|max:255',
            'file_1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'file_1.max' => 'Ukuran file maksimal 2MB',
            'file_2.max' => 'Ukuran file maksimal 2MB',
            'file_3.max' => 'Ukuran file maksimal 2MB',
        ]);

        // Handle file uploads
        if ($request->hasFile('file_1')) {
            $validated['file_1'] = $request->file('file_1')->store('volunteer-files', 'public');
        }
        if ($request->hasFile('file_2')) {
            $validated['file_2'] = $request->file('file_2')->store('volunteer-files', 'public');
        }
        if ($request->hasFile('file_3')) {
            $validated['file_3'] = $request->file('file_3')->store('volunteer-files', 'public');
        }

        // Set default status
        $validated['status'] = 'pending';

        // Create participant
        $participant = VolunteerParticipant::create($validated);

        return redirect()
            ->route('volunteer.show', $validated['volunteer_id'])
            ->with('success', 'Terima kasih! Pendaftaran Anda telah berhasil dikirim. Kami akan menghubungi Anda segera.');
    }

    /**
     * Show participant success page
     */
    public function success($id)
    {
        $participant = VolunteerParticipant::with('volunteer')->findOrFail($id);
        return view('volunteers.success', compact('participant'));
    }
}
