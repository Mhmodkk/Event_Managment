<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventAttendanceController extends Controller
{
    public function __invoke(Request $request, Event $event)
    {
        if (auth()->id() !== $event->user_id && !auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'غير مصرح لك بعرض إدارة الحضور لهذه الفعالية');
        }

        $attendings = $event->attendings()
            ->with('user', 'scanner')
            ->latest()
            ->get();

        $totalBooked = $attendings->count();
        $totalAttended = $attendings->whereNotNull('attended_at')->count();
        $remainingTickets = max(0, $event->num_tickets - $totalBooked);

        return view('events.attendance', compact(
            'event',
            'attendings',
            'totalBooked',
            'totalAttended',
            'remainingTickets'
        ));
    }
}
