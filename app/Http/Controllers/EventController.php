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
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $query = Event::with(['faculty', 'tags']);

        if ($request->has('my_faculty')) {
            $query->where('faculty_id', auth()->user()->faculty_id);
        }

        $events = $query->latest()->get();
        return view('events.index', compact('events'));
    }

    public function create(): View
    {
        $this->authorizeOrganizer();

        $faculties = Faculty::all();
        $tags = Tag::all();
        return view('events.create', compact('faculties', 'tags'));
    }

    public function store(CreateEventRequest $request): RedirectResponse
    {
        $this->authorizeOrganizer();

        if ($request->hasFile('image')) {
            $data = $request->validated();
            $data['image'] = Storage::putFile('events', $request->file('image'));
            $data['user_id'] = auth()->id();
            $data['slug'] = Str::slug($request->title);

            $event = Event::create($data);
            $event->tags()->attach($request->tags);
            return to_route('events.index')->with('success', 'Event created successfully!');
        }

        return back()->with('error', 'Image is required.');
    }

    public function edit(Event $event): View
    {
        $this->authorizeOwner($event);

        $faculties = Faculty::all();
        $tags = Tag::all();
        return view('events.edit', compact('faculties', 'tags', 'event'));
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $this->authorizeOwner($event);

        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            $data['image'] = Storage::putFile('events', $request->file('image'));
        }

        $data['slug'] = Str::slug($request->title);
        $event->update($data);
        $event->tags()->sync($request->tags);

        return to_route('events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->authorizeOwner($event);

        Storage::delete($event->image);
        $event->tags()->detach();
        $event->delete();

        return to_route('events.index')->with('success', 'Event deleted.');
    }

    protected function authorizeOrganizer() {
        if (!auth()->user()->isOrganizer()) abort(403, 'Organizer access required.');
    }

    protected function authorizeOwner(Event $event) {
        if (auth()->id() !== $event->user_id) abort(403, 'You do not own this event.');
    }
}
