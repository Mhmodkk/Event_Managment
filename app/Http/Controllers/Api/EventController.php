<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query()
            ->with(['user', 'faculty'])
            ->latest();

        if ($request->filled('faculty_id')) {
            $query->where('faculty_id', $request->faculty_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $events = $query->paginate(12);

        return response()->json([
            'data'         => $events->items(),
            'current_page' => $events->currentPage(),
            'last_page'    => $events->lastPage(),
            'per_page'     => $events->perPage(),
            'total'        => $events->total(),
        ]);
    }

    public function show(Event $event)
    {
        $event->load([
            'user',
            'faculty',
            'tags',
            'comments' => fn($q) => $q->latest()->take(10),
            'likes',
            'attendings',
        ]);

        return response()->json([
            'data' => $event,
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user || !in_array($user->role, ['organizer'])) {
            return response()->json([
                'error' => 'غير مصرح لك بإنشاء فعاليات، هذه الخاصية للمشرفين فقط'
            ], 403);
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'start_time'  => 'required|date_format:H:i',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'faculty_id'  => 'required|exists:faculties,id',
            'num_tickets' => 'required|integer|min:1',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        $validated['slug'] = Str::slug($validated['title'] . '-' . now()->format('YmdHis'));

        $event = Event::create(array_merge(
            $validated,
            ['user_id' => $user->id]
        ));

        if ($request->filled('tags')) {
            $event->tags()->sync($request->input('tags'));
        }

        $event->load(['user', 'faculty', 'tags']);

        return response()->json([
            'message' => 'تم إنشاء الفعالية بنجاح',
            'data'    => $event,
        ], 201);
    }

    public function update(Request $request, Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            return response()->json(['error' => 'غير مصرح لك بتعديل هذه الفعالية'], 403);
        }

        $validated = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'start_date'  => 'sometimes|date',
            'end_date'    => 'sometimes|date|after_or_equal:start_date',
            'start_time'  => 'sometimes|date_format:H:i',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'faculty_id'  => 'sometimes|exists:faculties,id',
            'num_tickets' => 'sometimes|integer|min:1',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        if ($request->filled('title')) {
            $validated['slug'] = Str::slug($validated['title'] . '-' . $event->id);
        }

        $event->update($validated);

        if ($request->filled('tags')) {
            $event->tags()->sync($request->input('tags'));
        }

        $event->load(['user', 'faculty', 'tags']);

        return response()->json([
            'message' => 'تم تحديث الفعالية بنجاح',
            'data'    => $event->fresh(),
        ]);
    }

    public function destroy(Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            return response()->json(['error' => 'غير مصرح لك بحذف هذه الفعالية'], 403);
        }

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return response()->json([
            'message' => 'تم حذف الفعالية بنجاح'
        ]);
    }
}
