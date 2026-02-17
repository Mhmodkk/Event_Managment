<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Faculty;
use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        // تم استبدال country بـ faculty
        $events = Event::with('faculty')->get();
        return view('events.index', compact('events'));
    }

    public function create(): View
    {
        if (!auth()->user()->isOrganizer()) {
            abort(403, 'عذراً، يجب أن تملك صلاحية منظم في جامعة الحواش للقيام بهذا الإجراء.');
        }

        $faculties = Faculty::all();
        $tags = Tag::all();
        return view('events.create', compact('faculties', 'tags'));
    }

    public function store(CreateEventRequest $request): RedirectResponse
    {
        if (!auth()->user()->isOrganizer()) {
            abort(403);
        }

        if ($request->hasFile('image')) {
            $data = $request->validated();
            $data['image'] = Storage::putFile('events', $request->file('image'));
            $data['user_id'] = auth()->id();
            $data['slug'] = Str::slug($request->title);

            $event = Event::create($data);
            $event->tags()->attach($request->tags);
            return to_route('events.index');
        } else {
            return back();
        }
    }

    public function edit(Event $event): View
    {
        if (auth()->id() !== $event->user_id) {
            abort(403);
        }

        $faculties = Faculty::all();
        $tags = Tag::all();
        return view('events.edit', compact('faculties', 'tags', 'event'));
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        if (auth()->id() !== $event->user_id) {
            abort(403);
        }

        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            $data['image'] = Storage::putFile('events', $request->file('image'));
        }

        $data['slug'] = Str::slug($request->title);
        $event->update($data);
        $event->tags()->sync($request->tags);
        return to_route('events.index');
    }

    public function destroy(Event $event): RedirectResponse
    {
        if (auth()->id() !== $event->user_id) {
            abort(403);
        }

        Storage::delete($event->image);
        $event->tags()->detach();
        $event->delete();
        return to_route('events.index');
    }
}
