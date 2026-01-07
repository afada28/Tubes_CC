<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
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
        $aboutItems = About::latest()->paginate(10);
        return view('admin.about.index', compact('aboutItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'gallery_title_1' => 'nullable|string',
            'gallery_content_1' => 'nullable|string',
            'gallery_photo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_title_2' => 'nullable|string',
            'gallery_content_2' => 'nullable|string',
            'gallery_photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create new about item
        $aboutItems = new About();
        $aboutItems->title = $request->title;
        $aboutItems->subtitle = $request->subtitle;
        $aboutItems->gallery_title_1 = $request->gallery_title_1;
        $aboutItems->gallery_content_1 = $request->gallery_content_1;
        $aboutItems->gallery_photo_1 = $request->gallery_photo_1;
        $aboutItems->gallery_title_2 = $request->gallery_title_2;
        $aboutItems->gallery_content_2 = $request->gallery_content_2;
        $aboutItems->gallery_photo_2 = $request->gallery_photo_2;

        // Handle file uploads
        if ($request->hasFile('gallery_photo_1')) {
            $aboutItems->gallery_photo_1 = $request->file('gallery_photo_1')->store('about', 'public');
        }

        if ($request->hasFile('gallery_photo_2')) {
            $aboutItems->gallery_photo_2 = $request->file('gallery_photo_2')->store('about', 'public');
        }

        $aboutItems->save();

        return redirect()->route('about.index')->with('success', 'About item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $aboutItems = About::findOrFail($id);
        return view('admin.about.show', compact('aboutItems'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $aboutItems = About::findOrFail($id);
        return view('admin.about.edit', compact('aboutItems'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'gallery_title_1' => 'nullable|string',
            'gallery_content_1' => 'nullable|string',
            'gallery_photo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_title_2' => 'nullable|string',
            'gallery_content_2' => 'nullable|string',
            'gallery_photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update about item
        $aboutItems = About::findOrFail($id);
        $aboutItems->title = $request->title;
        $aboutItems->subtitle = $request->subtitle;
        $aboutItems->gallery_title_1 = $request->gallery_title_1;
        $aboutItems->gallery_content_1 = $request->gallery_content_1;
        // JANGAN SET gallery_photo_1 dan gallery_photo_2 di sini!
        // $aboutItems->gallery_photo_1 = $request->gallery_photo_1; ❌ HAPUS INI
        $aboutItems->gallery_title_2 = $request->gallery_title_2;
        $aboutItems->gallery_content_2 = $request->gallery_content_2;
        // $aboutItems->gallery_photo_2 = $request->gallery_photo_2; ❌ HAPUS INI

        // Handle file uploads - HANYA jika ada file baru
        if ($request->hasFile('gallery_photo_1')) {
            // Delete old image if exists
            if ($aboutItems->gallery_photo_1) {
                Storage::disk('public')->delete($aboutItems->gallery_photo_1);
            }
            $aboutItems->gallery_photo_1 = $request->file('gallery_photo_1')->store('about', 'public');
        }

        if ($request->hasFile('gallery_photo_2')) {
            // Delete old image if exists
            if ($aboutItems->gallery_photo_2) {
                Storage::disk('public')->delete($aboutItems->gallery_photo_2);
            }
            $aboutItems->gallery_photo_2 = $request->file('gallery_photo_2')->store('about', 'public');
        }

        $aboutItems->save();

        return redirect()->route('about.index')->with('success', 'About item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aboutItems = About::findOrFail($id);

        // Delete images if they exist
        if ($aboutItems->gallery_photo_1) {
            Storage::disk('public')->delete($aboutItems->gallery_photo_1);
        }

        if ($aboutItems->gallery_photo_2) {
            Storage::disk('public')->delete($aboutItems->gallery_photo_2);
        }

        $aboutItems->delete();

        return redirect()->route('about.index')->with('success', 'About item deleted successfully.');
    }
}
