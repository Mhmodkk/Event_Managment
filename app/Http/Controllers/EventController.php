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
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $query = Event::with(['faculty', 'tags']);

        if ($request->has('my_faculty')) {
            $query->where('faculty_id', auth()->user()->faculty_id);
        }

        $events = $query->latest()->paginate(10);

        return view('events.index', compact('events'));
    }

    public function create(): View
    {
        $faculties = Faculty::all();
        $tags = Tag::all();

        return view('events.create', compact('faculties', 'tags'));
    }

    public function store(CreateEventRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);

        if ($request->has('excluded_days_json')) {
            $data['excluded_days'] = $request->excluded_days_json;
        }

        $data['is_public'] = $request->boolean('is_public');

        $event = Event::create($data);

        if ($request->has('tags')) {
            $event->tags()->sync($request->tags);
        }

        $qrPath = 'qrcodes/event-' . $event->id . '.svg';

        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }


        QrCode::size(300)
            ->style('round')
            ->margin(1)
            ->generate(route('eventShow', $event->id), storage_path('app/public/' . $qrPath));

        $event->update(['qr_code' => $qrPath]);

        return redirect()->route('events.index')->with('success', 'تم إنشاء الفعالية بنجاح');
    }

    public function show(Event $event): View
    {
        $event->load(['faculty', 'tags', 'user', 'comments.user']);

        $like = $savedEvent = $attending = null;

        if (auth()->check()) {
            $like = $event->likes()->where('user_id', auth()->id())->first();
            $savedEvent = $event->savedEvents()->where('user_id', auth()->id())->first();
            $attending = $event->attendings()->where('user_id', auth()->id())->first();
        }

        return view('events.show', compact('event', 'like', 'savedEvent', 'attending'));
    }

    public function edit(Event $event): View
    {
        $this->authorizeOwner($event);

        $faculties = Faculty::all();
        $tags = Tag::all();

        return view('events.edit', compact('event', 'faculties', 'tags'));
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $this->authorizeOwner($event);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        if ($request->has('excluded_days_json')) {
            $data['excluded_days'] = $request->excluded_days_json;
        }

        $data['is_public'] = $request->boolean('is_public');

        $event->update($data);

        if ($request->has('tags')) {
            $event->tags()->sync($request->tags);
        }

        return redirect()->route('events.index')->with('success', 'تم تحديث الفعالية بنجاح');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->authorizeOwner($event);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        if ($event->qr_code) {
            Storage::disk('public')->delete($event->qr_code);
        }

        $event->tags()->detach();
        $event->delete();

        return redirect()->route('events.index')->with('success', 'تم حذف الفعالية');
    }

    protected function authorizeOwner(Event $event)
    {
        if (auth()->id() !== $event->user_id) {
            abort(403, 'لست صاحب هذه الفعالية');
        }
    }

    public function faculties()
    {
        $faculties = Faculty::all();
        return view('faculties', compact('faculties'));
    }

    public function types()
    {
        return view('event-types');
    }

    public function archive()
    {
        $events = Event::where('start_date', '<', now())
            ->with(['faculty', 'tags'])
            ->latest()
            ->paginate(12);
        return view('archive', compact('events'));
    }

    public function welcome()
    {
        $upcomingEvents = Event::with(['faculty'])
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->take(8)
            ->get();

        $recentEvents = Event::with(['faculty'])
            ->where('end_date', '<', now())
            ->where('end_date', '>=', now()->subDays(30))
            ->orderBy('end_date', 'desc')
            ->take(8)
            ->get();

        return view('welcome', compact('upcomingEvents', 'recentEvents'));
    }
}
