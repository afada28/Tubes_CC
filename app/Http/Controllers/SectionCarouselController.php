<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SectionCarousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionCarouselController extends Controller
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
        $carouselItems = SectionCarousel::all();
        return view('admin.carousel.index', compact('carouselItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title_1' => 'required|string|max:255',
            'content_1' => 'nullable|string',
            'photo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_2' => 'nullable|string|max:255',
            'content_2' => 'nullable|string',
            'photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_3' => 'nullable|string|max:255',
            'content_3' => 'nullable|string',
            'photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create new carousel item
        $carouselItem = new SectionCarousel();
        $carouselItem->title_1 = $request->title_1;
        $carouselItem->content_1 = $request->content_1;
        $carouselItem->title_2 = $request->title_2;
        $carouselItem->content_2 = $request->content_2;
        $carouselItem->title_3 = $request->title_3;
        $carouselItem->content_3 = $request->content_3;

        // Handle file uploads
        if ($request->hasFile('photo_1')) {
            $carouselItem->photo_1 = $request->file('photo_1')->store('carousel', 'public');
        }

        if ($request->hasFile('photo_2')) {
            $carouselItem->photo_2 = $request->file('photo_2')->store('carousel', 'public');
        }

        if ($request->hasFile('photo_3')) {
            $carouselItem->photo_3 = $request->file('photo_3')->store('carousel', 'public');
        }

        $carouselItem->save();

        return redirect()->route('carousel.index')->with('success', 'Carousel item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carouselItem = SectionCarousel::findOrFail($id);
        return view('admin.carousel.edit', compact('carouselItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title_1' => 'required|string|max:255',
            'content_1' => 'nullable|string',
            'photo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_2' => 'nullable|string|max:255',
            'content_2' => 'nullable|string',
            'photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_3' => 'nullable|string|max:255',
            'content_3' => 'nullable|string',
            'photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update carousel item
        $carouselItem = SectionCarousel::findOrFail($id);
        $carouselItem->title_1 = $request->title_1;
        $carouselItem->content_1 = $request->content_1;
        $carouselItem->title_2 = $request->title_2;
        $carouselItem->content_2 = $request->content_2;
        $carouselItem->title_3 = $request->title_3;
        $carouselItem->content_3 = $request->content_3;

        // Handle file uploads
        if ($request->hasFile('photo_1')) {
            // Delete old image if exists
            if ($carouselItem->photo_1) {
                Storage::disk('public')->delete($carouselItem->photo_1);
            }
            $carouselItem->photo_1 = $request->file('photo_1')->store('carousel', 'public');
        }

        if ($request->hasFile('photo_2')) {
            // Delete old image if exists
            if ($carouselItem->photo_2) {
                Storage::disk('public')->delete($carouselItem->photo_2);
            }
            $carouselItem->photo_2 = $request->file('photo_2')->store('carousel', 'public');
        }

        if ($request->hasFile('photo_3')) {
            // Delete old image if exists
            if ($carouselItem->photo_3) {
                Storage::disk('public')->delete($carouselItem->photo_3);
            }
            $carouselItem->photo_3 = $request->file('photo_3')->store('carousel', 'public');
        }

        $carouselItem->save();

        return redirect()->route('carousel.index')->with('success', 'Carousel item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carouselItem = SectionCarousel::findOrFail($id);

        // Delete images if they exist
        if ($carouselItem->photo_1) {
            Storage::disk('public')->delete($carouselItem->photo_1);
        }

        if ($carouselItem->photo_2) {
            Storage::disk('public')->delete($carouselItem->photo_2);
        }

        if ($carouselItem->photo_3) {
            Storage::disk('public')->delete($carouselItem->photo_3);
        }

        $carouselItem->delete();

        return redirect()->route('carousel.index')->with('success', 'Carousel item deleted successfully.');
    }
}