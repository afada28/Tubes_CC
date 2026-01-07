<?php

namespace App\Http\Controllers;

use App\Models\FounderJourney;
use Illuminate\Http\Request;

class PublicJourneyController extends Controller
{
        /**
     * Display a listing of all journeys.
     */
    public function index()
    {
        // Ambil semua journey, urutkan berdasarkan tahun terbaru
        $journeys = FounderJourney::orderBy('date_start', 'desc')->get();

        // Data untuk header section
        $pageHeader = [
            'badge' => 'Founder Journey',
            'title' => 'Our',
            'title_highlight' => 'Founder',
            'title_suffix' => 'Journey',
            'subtitle' => 'From a simple dream to realizing real change for thousands of Indonesian families'
        ];

        return view('journey.index', compact('journeys', 'pageHeader'));
    }

    /**
     * Display the specified journey.
     */
    public function show($id)
    {
        // Ambil journey berdasarkan ID
        $journey = FounderJourney::findOrFail($id);

        // Ambil journey sebelum dan sesudah untuk navigasi
        $previousJourney = FounderJourney::where('date_start', '<', $journey->date_start)
            ->orderBy('date_start', 'desc')
            ->first();

        $nextJourney = FounderJourney::where('date_start', '>', $journey->date_start)
            ->orderBy('date_start', 'asc')
            ->first();

        // Ambil semua foto yang ada
        $photos = [];
        for ($i = 1; $i <= 10; $i++) {
            $photoField = "photo_$i";
            if (!empty($journey->$photoField)) {
                $photos[] = $journey->$photoField;
            }
        }

        // Journey terkait (3 journey terdekat berdasarkan tanggal)
        $relatedJourneys = FounderJourney::where('id', '!=', $journey->id)
            ->orderBy('date_start', 'desc')
            ->limit(3)
            ->get();

        return view('journey.show', compact('journey', 'photos', 'previousJourney', 'nextJourney', 'relatedJourneys'));
    }
}
