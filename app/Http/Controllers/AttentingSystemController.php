<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AttentingSystemController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $attending = $event->attendings()->where('user_id', auth()->id())->first();

        if ($attending) {
            $attending->delete();
            return response()->json(['status' => 'removed', 'message' => 'Reservation cancelled.']);
        } else {

            $bookedCount = $event->attendings()->count();

            if ($bookedCount >= $event->num_tickets) {
                return response()->json(['error' => 'Sorry, no more seats available for this event.'], 422);
            }

            $newAttending = $event->attendings()->create([
                'user_id' => auth()->id(),
                'num_tickets' => 1
            ]);

            return response()->json(['status' => 'added', 'data' => $newAttending]);
        }
    }
}
