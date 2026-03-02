<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attending;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AttendingController extends Controller
{

    public function attend(Request $request, Event $event)
    {


        $validated = $request->validate([
            'num_tickets' => 'required|integer|min:1',
        ]);

        $requestedTickets = $validated['num_tickets'];

        return DB::transaction(function () use ($event, $requestedTickets) {

            $booked = Attending::where('event_id', $event->id)
                ->sum('num_tickets');

            $remaining = $event->num_tickets - $booked;

            if ($remaining < $requestedTickets) {
                throw ValidationException::withMessages([
                    'num_tickets' => "التذاكر المتبقية فقط {$remaining}، لا يمكن حجز {$requestedTickets}",
                ]);
            }

            $existing = Attending::where('event_id', $event->id)
                ->where('user_id', auth()->id())
                ->first();

            if ($existing) {
                $newTotal = $existing->num_tickets + $requestedTickets;

                if ($remaining < $newTotal - $existing->num_tickets) {
                    throw ValidationException::withMessages([
                        'num_tickets' => 'الكمية المطلوبة تتجاوز المتبقي بعد الحجز السابق',
                    ]);
                }

                $existing->update(['num_tickets' => $newTotal]);

                $attendance = $existing->fresh();
            } else {
                $attendance = Attending::create([
                    'user_id'     => auth()->id(),
                    'event_id'    => $event->id,
                    'num_tickets' => $requestedTickets,
                ]);
            }

            return response()->json([
                'message'     => 'تم حجز التذاكر بنجاح',
                'attendance'  => $attendance->load('event'),
                'remaining'   => $event->num_tickets - Attending::where('event_id', $event->id)->sum('num_tickets'),
            ], 201);
        });
    }

    /**
     * Cancel attendance / delete booking
     */
    public function cancel(Event $event)
    {
        $attendance = Attending::where('event_id', $event->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $attendance->delete();

        return response()->json([
            'message'   => 'تم إلغاء الحجز بنجاح',
            'remaining' => $event->num_tickets - Attending::where('event_id', $event->id)->sum('num_tickets'),
        ]);
    }

    public function myAttendings(Request $request)
    {
        $query = Attending::where('user_id', auth()->id())
            ->with([
                'event' => function ($q) {
                    $q->with(['user', 'faculty']);
                }
            ])
            ->latest();

        if ($request->boolean('upcoming')) {
            $query->whereHas('event', function ($q) {
                $q->where('start_date', '>=', now()->toDateString());
            });
        }

        $attendings = $query->paginate(10);

        return response()->json([
            'data'         => $attendings->items(),
            'current_page' => $attendings->currentPage(),
            'last_page'    => $attendings->lastPage(),
            'total'        => $attendings->total(),
        ]);
    }

    public function attendees(Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            return response()->json(['error' => 'غير مصرح'], 403);
        }

        $attendees = Attending::where('event_id', $event->id)
            ->with('user')
            ->get();

        return response()->json([
            'data' => $attendees,
            'total_tickets_booked' => $attendees->sum('num_tickets'),
            'remaining' => $event->num_tickets - $attendees->sum('num_tickets'),
        ]);
    }
}
