<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\InfoDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    /**
     * Display a listing of donation programs
     */
    public function index()
    {
        $donations = InfoDonation::where('status', 'active')
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'desc')
            ->with('donations')
            ->paginate(9);

        return view('donations.index', compact('donations'));
    }

    /**
     * Show the donation detail page
     */
    public function show($id)
    {
        $infoDonation = InfoDonation::with('donations')->findOrFail($id);

        // Calculate donation statistics
        $totalDonations = $infoDonation->donations->sum('donate');
        $donorCount = $infoDonation->donations->count();
        $targetDonation = $infoDonation->target; // Rp 10 juta sebagai target default
        $progressPercentage = min(($totalDonations / $targetDonation) * 100, 100);

        // Get recent donors
        $recentDonors = $infoDonation->donations()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Get related donations (same category or recent)
        $relatedDonations = InfoDonation::where('id', '!=', $id)
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->take(3)
            ->get();

        return view('donations.show', compact(
            'infoDonation',
            'totalDonations',
            'donorCount',
            'targetDonation',
            'progressPercentage',
            'recentDonors',
            'relatedDonations'
        ));
    }

    /**
     * Store a new donation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'info_donation_id' => 'required|exists:info_donation,id',
            'name' => 'required|string|max:255',
            'donate' => 'required|numeric',
            'address' => 'required|string|max:500',
            'phonenumber' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'message' => 'nullable|string|max:500',
        ], [
            'photo.image' => 'File harus berupa gambar',
            'photo.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('donation-proofs', 'public');
        }

        // Create donation
        $donation = Donation::create($validated);

        return redirect()
            ->route('donation.show', $validated['info_donation_id'])
            ->with('success', 'Terima kasih! Donasi Anda telah berhasil dikirim.');
    }

    /**
     * Show donation success page
     */
    public function success($id)
    {
        $donation = Donation::with('infoDonation')->findOrFail($id);
        return view('donations.success', compact('donation'));
    }
}