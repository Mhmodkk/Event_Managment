<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttentingSystemController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $bookedCount = $event->attendings()->count();
        if ($bookedCount >= $event->num_tickets) {
            return response()->json(['error' => 'لا توجد مقاعد متاحة لهذه الفعالية'], 422);
        }

        if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())) {
            return response()->json([
                'status'  => 'error',
                'message' => 'المدراء والمشرفين لا يمكنهم حجز حضور في الفعاليات'
            ], 403);
        }

        if (Auth::check()) {
            $attending = $event->attendings()->where('user_id', Auth::id())->first();

            if ($attending) {
                $attending->delete();
                return response()->json(['status' => 'removed', 'message' => 'تم إلغاء الحجز']);
            }

            $newAttending = $event->attendings()->create([
                'user_id' => Auth::id(),
                'num_tickets' => 1,
            ]);

            return response()->json(['status' => 'added', 'data' => $newAttending]);
        }

        if (!$event->is_public) {
            return response()->json(['error' => 'هذه الفعالية داخلية فقط، يجب تسجيل الدخول'], 403);
        }

        $request->validate([
            'guest_name'  => 'nullable|string|max:255',
            'guest_phone' => 'nullable|string|max:20',
            'guest_email' => 'nullable|email|max:255',
        ]);

        $newAttending = $event->attendings()->create([
            'guest_name'  => $request->guest_name,
            'guest_phone' => $request->guest_phone,
            'guest_email' => $request->guest_email,
            'qr_scanned_by' => null,
        ]);

        return response()->json([
            'status'  => 'added',
            'message' => 'تم تسجيل حضورك كضيف بنجاح',
            'data'    => $newAttending
        ]);
    }
}
