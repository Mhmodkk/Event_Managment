<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Attending;
use Illuminate\Http\Request;

class EventAttendanceController extends Controller
{
    // الدالة الأصلية (إدارة الحضور للمشرفين)
    public function __invoke(Request $request, Event $event)
    {
        if (auth()->id() !== $event->user_id && !auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'غير مصرح لك بعرض إدارة الحضور لهذه الفعالية');
        }
        $attendings = $event->attendings()->with('user', 'scanner')->latest()->get();
        $totalBooked = $attendings->count();
        $totalAttended = $attendings->whereNotNull('attended_at')->count();
        $remainingTickets = max(0, $event->num_tickets - $totalBooked);
        return view('events.attendance', compact('event', 'attendings', 'totalBooked', 'totalAttended', 'remainingTickets'));
    }

    public function publicShow($token)
    {
        $event = Event::where('attendance_token', $token)->firstOrFail();
        $error = null;
        $alreadyAttended = false;

        if (!$event->canRegisterAttendance()) {
            $error = 'عذراً، تسجيل الحضور غير متاح في هذا الوقت. يرجى التأكد من وقت الفعالية.';
        }

        if (!$error && auth()->check()) {
            $exists = Attending::where('event_id', $event->id)->where('user_id', auth()->id())->exists();
            if (!$exists) {
                Attending::create([
                    'event_id' => $event->id,
                    'user_id' => auth()->id(),
                    'attendee_name' => auth()->user()->name,
                    'attendee_type' => auth()->user()->role === 'admin' ? 'مشرف' : 'طالب',
                    'num_tickets' => 1,
                    'attended_at' => now(),
                ]);
            }
            $alreadyAttended = true;
        }

        return view('events.attendance-public', compact('event', 'error', 'alreadyAttended'));
    }

    public function publicRegister(Request $request, $token)
    {
        $event = Event::where('attendance_token', $token)->firstOrFail();

        if (!$event->canRegisterAttendance()) {
            return back()->with('error', 'تسجيل الحضور غير متاح حالياً.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'nullable|string|max:50',
        ]);

        $exists = Attending::where('event_id', $event->id)
            ->where(function ($q) use ($request) {
                $q->where('attendee_name', $request->name)
                    ->orWhere('student_id', $request->student_id);
            })->exists();

        if ($exists) {
            return back()->with('error', 'تم تسجيل حضورك مسبقاً في هذه الفعالية.');
        }

        Attending::create([
            'event_id' => $event->id,
            'user_id' => null,
            'attendee_name' => $request->name,
            'attendee_type' => 'زائر',
            'student_id' => $request->student_id,
            'num_tickets' => 1,
            'attended_at' => now(),
        ]);

        return back()->with('success', '✅ تم تسجيل حضورك بنجاح في: ' . $event->title);
    }
}
