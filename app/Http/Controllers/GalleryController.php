<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('galleries.index', compact('galleries'));
    }

    public function create()
    {
        $events = Event::where('user_id', auth()->id())->get();
        return view('galleries.create', compact('events'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isOrganizer()) {
            abort(403, 'Students cannot upload to gallery');
        }

        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'caption'  => 'required|string|max:255',
            'image'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        auth()->user()->galleries()->create([
            'event_id' => $request->event_id,
            'caption'  => $request->caption,
            'image'    => $path,
        ]);

        return to_route('galleries.index')->with('success', 'تم إضافة الصورة بنجاح!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        if (!auth()->user()->isOrganizer()) {
            abort(403, 'Students cannot edit gallery');
        }
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        if (!auth()->user()->isOrganizer()) {
            abort(403, 'Students cannot update gallery');
        }
        $path = $gallery->image;
        $this->validate($request, [
            'caption' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($gallery->image);
            $path = $request->file('image')->store('galleries', 'public');
        }
        $gallery->update([
            'caption' => $request->input('caption'),
            'image' => $path,
        ]);
        return to_route('galleries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if (!auth()->user()->isOrganizer()) {
            abort(403, 'Students cannot delete from gallery');
        }
        Storage::delete($gallery->image);
        $gallery->delete();
        return back();
    }
}
