<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventScanController extends Controller
{

    public function index()
    {
        $events = Event::where('user_id', auth()->id())
            ->orWhere('is_public', true)
            ->orderBy('start_date', 'desc')
            ->get();

        return view('events.scan-index', compact('events'));
    }


    public function __invoke(Request $request, Event $event)
    {
        if (
            auth()->id() !== $event->user_id &&
            !auth()->user()->isAdmin()
        ) {
            abort(403, 'غير مصرح لك بمسح الحضور لهذه الفعالية');
        }

        return view('events.scan', compact('event'));
    }
}
