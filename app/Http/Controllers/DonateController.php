<?php

namespace App\Http\Controllers;

use App\Models\InfoDonation;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infoDonations = InfoDonation::orderBy('created_at', 'desc')->paginate(10);

        // Calculate overall statistics
        $totalDonors = Donation::count();
        $totalCollected = Donation::sum('donate');
        $totalTarget = InfoDonation::sum('target');

        return view('admin.donate.index', compact('infoDonations', 'totalDonors', 'totalCollected', 'totalTarget'));
    }

    /**
     * Show the participants of a donation program.
     */
    public function participants($id)
    {
        $infoDonation = InfoDonation::findOrFail($id);

        // Get paginated donations for this info_donation
        $donations = Donation::where('info_donation_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Calculate statistics
        $totalDonations = Donation::where('info_donation_id', $id)->sum('donate');
        $progressPercentage = $infoDonation->target > 0 ?
            min(($totalDonations / $infoDonation->target) * 100, 100) : 0;

        return view('admin.donate.participants', compact(
            'infoDonation',
            'donations',
            'totalDonations',
            'progressPercentage'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.donate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'payment_method_1' => 'required|string|max:255',
            'payment_method_2' => 'nullable|string|max:255',
            'payment_method_3' => 'nullable|string|max:255',
            'pic_payment_method_1' => 'required|string|max:255',
            'pic_payment_method_2' => 'nullable|string|max:255',
            'pic_payment_method_3' => 'nullable|string|max:255',
            'contact_person_1' => 'required|string|max:255',
            'contact_person_2' => 'nullable|string|max:255',
            'contact_person_3' => 'nullable|string|max:255',
            'photo_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
            'target' => 'required|numeric|min:1',
        ]);

        // Handle file uploads
        if ($request->hasFile('photo_1')) {
            $validated['photo_1'] = $request->file('photo_1')->store('donations', 'public');
        }
        if ($request->hasFile('photo_2')) {
            $validated['photo_2'] = $request->file('photo_2')->store('donations', 'public');
        }
        if ($request->hasFile('photo_3')) {
            $validated['photo_3'] = $request->file('photo_3')->store('donations', 'public');
        }

        InfoDonation::create($validated);

        return redirect()->route('donate.index')
            ->with('success', 'Donation information created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $infoDonation = InfoDonation::with('donations')->findOrFail($id);
        return view('admin.donate.show', compact('infoDonation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $infoDonation = InfoDonation::findOrFail($id);
        return view('admin.donate.edit', compact('infoDonation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $infoDonation = InfoDonation::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'payment_method_1' => 'required|string|max:255',
            'payment_method_2' => 'nullable|string|max:255',
            'payment_method_3' => 'nullable|string|max:255',
            'pic_payment_method_1' => 'required|string|max:255',
            'pic_payment_method_2' => 'nullable|string|max:255',
            'pic_payment_method_3' => 'nullable|string|max:255',
            'contact_person_1' => 'required|string|max:255',
            'contact_person_2' => 'nullable|string|max:255',
            'contact_person_3' => 'nullable|string|max:255',
            'photo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
            'target' => 'required|numeric|min:1',
        ]);

        // Handle file uploads and delete old files
        if ($request->hasFile('photo_1')) {
            if ($infoDonation->photo_1) {
                Storage::disk('public')->delete($infoDonation->photo_1);
            }
            $validated['photo_1'] = $request->file('photo_1')->store('donations', 'public');
        }
        if ($request->hasFile('photo_2')) {
            if ($infoDonation->photo_2) {
                Storage::disk('public')->delete($infoDonation->photo_2);
            }
            $validated['photo_2'] = $request->file('photo_2')->store('donations', 'public');
        }
        if ($request->hasFile('photo_3')) {
            if ($infoDonation->photo_3) {
                Storage::disk('public')->delete($infoDonation->photo_3);
            }
            $validated['photo_3'] = $request->file('photo_3')->store('donations', 'public');
        }

        $infoDonation->update($validated);

        return redirect()->route('donate.index')
            ->with('success', 'Donation information updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $infoDonation = InfoDonation::findOrFail($id);

        // Delete associated photos
        if ($infoDonation->photo_1) {
            Storage::disk('public')->delete($infoDonation->photo_1);
        }
        if ($infoDonation->photo_2) {
            Storage::disk('public')->delete($infoDonation->photo_2);
        }
        if ($infoDonation->photo_3) {
            Storage::disk('public')->delete($infoDonation->photo_3);
        }

        $infoDonation->delete();

        return redirect()->route('donate.index')
            ->with('success', 'Donation information deleted successfully!');
    }

    /**
     * Export participants data as CSV
     */
    public function exportParticipants($id)
    {
        $infoDonation = InfoDonation::findOrFail($id);
        $donations = Donation::where('info_donation_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'donation_participants_' . \Str::slug($infoDonation->title) . '_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');

            // CSV Header
            fputcsv($file, [
                'Name',
                'Phone Number',
                'Address',
                'Donation Amount',
                'Message',
                'Date',
                'Time'
            ]);

            // CSV Data
            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->name,
                    $donation->phonenumber,
                    $donation->address,
                    $donation->donate,
                    $donation->message ?? '',
                    $donation->created_at->format('Y-m-d'),
                    $donation->created_at->format('H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}