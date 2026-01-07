<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MilestoneController extends Controller
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
        $milestoneItems = Milestone::latest()->paginate(10);
        return view('admin.milestone.index', compact('milestoneItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.milestone.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'timeline_title_1' => 'required|string|max:255',
            'timeline_content_1' => 'required|string|max:255',
            'timeline_title_2' => 'required|string|max:255',
            'timeline_content_2' => 'required|string|max:255',
            'timeline_title_3' => 'required|string|max:255',
            'timeline_content_3' => 'required|string|max:255',
            'timeline_title_4' => 'required|string|max:255',
            'timeline_content_4' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create new about item
        $milestoneItems = new Milestone();
        $milestoneItems->timeline_title_1 = $request->timeline_title_1;
        $milestoneItems->timeline_content_1 = $request->timeline_content_1;
        $milestoneItems->timeline_title_2 = $request->timeline_title_2;
        $milestoneItems->timeline_content_2 = $request->timeline_content_2;
        $milestoneItems->timeline_title_3 = $request->timeline_title_3;
        $milestoneItems->timeline_content_3 = $request->timeline_content_3;
        $milestoneItems->timeline_title_4 = $request->timeline_title_4;
        $milestoneItems->timeline_content_4 = $request->timeline_content_4;
        $milestoneItems->photo = $request->photo;

        // Handle file uploads
        if ($request->hasFile('photo')) {
            $milestoneItems->photo = $request->file('photo')->store('milestone', 'public');
        }

        $milestoneItems->save();

        return redirect()->route('milestone.index')->with('success', 'Milestone item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $milestoneItems = Milestone::findOrFail($id);
        return view('admin.milestone.show', compact('milestoneItems'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $milestoneItems = Milestone::findOrFail($id);
        return view('admin.milestone.edit', compact('milestoneItems'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'timeline_title_1' => 'required|string|max:255',
            'timeline_content_1' => 'required|string|max:255',
            'timeline_title_2' => 'required|string|max:255',
            'timeline_content_2' => 'required|string|max:255',
            'timeline_title_3' => 'required|string|max:255',
            'timeline_content_3' => 'required|string|max:255',
            'timeline_title_4' => 'required|string|max:255',
            'timeline_content_4' => 'required|string|max:255',
        ]);


        // Update about item
        $milestoneItems = Milestone::findOrFail($id);
        $milestoneItems->timeline_title_1 = $request->timeline_title_1;
        $milestoneItems->timeline_content_1 = $request->timeline_content_1;
        $milestoneItems->timeline_title_2 = $request->timeline_title_2;
        $milestoneItems->timeline_content_2 = $request->timeline_content_2;
        $milestoneItems->timeline_title_3 = $request->timeline_title_3;
        $milestoneItems->timeline_content_3 = $request->timeline_content_3;
        $milestoneItems->timeline_title_4 = $request->timeline_title_4;
        $milestoneItems->timeline_content_4 = $request->timeline_content_4;


        // Handle file uploads - HANYA jika ada file baru
        if ($request->hasFile('photo')) {
            // Delete old image if exists
            if ($milestoneItems->photo) {
                Storage::disk('public')->delete($milestoneItems->photo);
            }
            $milestoneItems->photo = $request->file('photo')->store('milestone', 'public');
        }

        $milestoneItems->save();

        return redirect()->route('milestone.index')->with('success', 'Milestone item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $milestoneItems = Milestone::findOrFail($id);

        // Delete images if they exist
        if ($milestoneItems->photo) {
            Storage::disk('public')->delete($milestoneItems->photo);
        }

        $milestoneItems->delete();

        return redirect()->route('milestone.index')->with('success', 'Milestone item deleted successfully.');
    }
}
