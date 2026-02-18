<?php

namespace App\Http\Controllers;

use App\Models\Event;

class AttendingEventController extends Controller
{
    public function __invoke()
    {
        $events = Event::with(['faculty', 'user'])
            ->whereHas('attendings', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('events.attendingEvents', compact('events'));
    }
}
