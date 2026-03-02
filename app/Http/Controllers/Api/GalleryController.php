<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * عرض جميع الصور في معرض فعالية معينة
     */
    public function index(Event $event)
    {
        $galleries = $event->galleries()
            ->latest()
            ->paginate(20);

        return response()->json([
            'data'         => $galleries->items(),
            'current_page' => $galleries->currentPage(),
            'last_page'    => $galleries->lastPage(),
            'total'        => $galleries->total(),
        ]);
    }

    /**
     * إضافة صورة جديدة لمعرض فعالية
     */
    public function store(Request $request, Event $event)
    {
        if ($event->user_id !== auth()->id() && !in_array(auth()->user()->role, ['organizer'])) {
            return response()->json(['error' => 'غير مصرح لك بإضافة صور لهذه الفعالية'], 403);
        }

        $validated = $request->validate([
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'caption' => 'nullable|string|max:500',
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        $gallery = Gallery::create([
            'event_id'    => $event->id,
            'user_id'     => auth()->id(),
            'image'       => $path,
            'caption' => $request->caption,
        ]);

        return response()->json([
            'message' => 'تم إضافة الصورة بنجاح',
            'data'    => $gallery->only(['id', 'image_url' => Storage::url($path), 'caption', 'created_at'])
        ], 201);
    }

    /**
     * عرض صورة معينة من المعرض
     */
    public function show(Gallery $gallery)
    {
        $gallery->load(['user' => fn($q) => $q->select('id', 'name'), 'event' => fn($q) => $q->select('id', 'title')]);

        return response()->json([
            'data' => [
                'id'          => $gallery->id,
                'image_url'   => Storage::url($gallery->image),
                'caption' => $gallery->caption,
                'user'        => $gallery->user,
                'event'       => $gallery->event,
                'created_at'  => $gallery->created_at,
            ]
        ]);
    }

    /**
     * حذف صورة من المعرض
     */
    public function destroy(Gallery $gallery)
    {
        $user = auth()->user();
        if ($gallery->user_id !== $user->id && $gallery->event->user_id !== $user->id && !in_array($user->role, ['organizer'])) {
            return response()->json(['error' => 'غير مصرح لك بحذف هذه الصورة'], 403);
        }

        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return response()->json(['message' => 'تم حذف الصورة بنجاح']);
    }
}
