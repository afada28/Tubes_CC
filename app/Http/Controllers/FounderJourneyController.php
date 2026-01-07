<?php

namespace App\Http\Controllers;

use App\Models\FounderJourney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FounderJourneyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journeyItems = FounderJourney::latest()->paginate(10);
        return view('admin.founder-journey.index', compact('journeyItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.founder-journey.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date_start' => 'nullable|date',
            'date_end' => 'nullable|date|after_or_equal:date_start',
            'location' => 'nullable|string',
            'photo_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_6' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_7' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_8' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_9' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_10' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create new journey item
        $journeyItems = new FounderJourney();
        $journeyItems->title = $request->title;
        $journeyItems->content = $request->content;
        $journeyItems->date_start = $request->date_start;
        $journeyItems->date_end = $request->date_end;
        $journeyItems->location = $request->location;

        // Handle file uploads
        for ($i = 1; $i <= 10; $i++) {
            $photoField = "photo_$i";
            if ($request->hasFile($photoField)) {
                $journeyItems->$photoField = $request->file($photoField)->store('founder-journey', 'public');
            }
        }

        $journeyItems->save();

        return redirect()->route('journey-founder.index')->with('success', 'Founder Journey item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $journeyItems = FounderJourney::findOrFail($id);
        return view('admin.founder-journey.show', compact('journeyItems'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $journeyItems = FounderJourney::findOrFail($id);
        return view('admin.founder-journey.edit', compact('journeyItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date_start' => 'nullable|date',
            'date_end' => 'nullable|date|after_or_equal:date_start',
            'location' => 'nullable|string',
            'photo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_6' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_7' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_8' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_9' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_10' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update journey item
        $journeyItems = FounderJourney::findOrFail($id);
        $journeyItems->title = $request->title;
        $journeyItems->content = $request->content;
        $journeyItems->date_start = $request->date_start;
        $journeyItems->date_end = $request->date_end;
        $journeyItems->location = $request->location;

        // Handle file uploads - HANYA jika ada file baru
        for ($i = 1; $i <= 10; $i++) {
            $photoField = "photo_$i";
            if ($request->hasFile($photoField)) {
                // Delete old image if exists
                if ($journeyItems->$photoField) {
                    Storage::disk('public')->delete($journeyItems->$photoField);
                }
                $journeyItems->$photoField = $request->file($photoField)->store('founder-journey', 'public');
            }
        }

        $journeyItems->save();

        return redirect()->route('journey-founder.index')->with('success', 'Founder Journey item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $journeyItems = FounderJourney::findOrFail($id);

        // Delete images if they exist
        for ($i = 1; $i <= 10; $i++) {
            $photoField = "photo_$i";
            if ($journeyItems->$photoField) {
                Storage::disk('public')->delete($journeyItems->$photoField);
            }
        }

        $journeyItems->delete();

        return redirect()->route('journey-founder.index')->with('success', 'Founder Journey item deleted successfully.');
    }
}