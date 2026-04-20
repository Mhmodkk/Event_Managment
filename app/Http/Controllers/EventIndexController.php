<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Faculty;
use Illuminate\Http\Request;

class EventIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $faculties = Faculty::all();

        $query = Event::with(['faculty', 'tags']);

        if ($request->has('faculty_id') && $request->faculty_id != '') {
            $query->where('faculty_id', $request->faculty_id);
        }

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if (auth()->check() && auth()->user()->faculty_id) {
            $userFacultyId = auth()->user()->faculty_id;
            $events = $query->orderByRaw("faculty_id = $userFacultyId DESC")
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        } else {
            $events = $query->orderBy('created_at', 'desc')->paginate(12);
        }

        return view('eventIndex', compact('events', 'faculties'));
    }
}
