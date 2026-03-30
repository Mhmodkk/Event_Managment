<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventScanController extends Controller
{
    public function __invoke(Request $request, Event $event)
    {
        if (auth()->id() !== $event->user_id && !auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'غير مصرح لك بمسح الحضور لهذه الفعالية');
        }

        return view('events.scan', compact('event'));
    }
}
