<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Attending;
use Illuminate\Http\Request;

class ScanTicketController extends Controller
{
    public function __invoke(Request $request, Event $event)
    {
        if (
            auth()->id() !== $event->user_id &&
            !auth()->user()->isAdmin() &&
            !auth()->user()->isSuperAdmin()
        ) {
            return response()->json([
                'status'  => 'error',
                'message' => 'غير مصرح لك بمسح الحضور لهذه الفعالية'
            ], 403);
        }

        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $code = trim($request->code);

        $attending = Attending::where('qr_token', $code)
            ->where('event_id', $event->id)
            ->first();

        if (!$attending) {
            return response()->json([
                'status'  => 'error',
                'message' => 'رمز QR غير صالح أو لا ينتمي لهذه الفعالية'
            ], 422);
        }

        if ($attending->attended_at !== null) {
            return response()->json([
                'status'  => 'warning',
                'message' => 'تم تسجيل حضور هذا الشخص مسبقاً في ' .
                    $attending->attended_at->format('H:i d/m/Y')
            ], 200);
        }

        $attending->update([
            'attended_at'   => now(),
            'qr_scanned_by' => auth()->id(),
        ]);

        return response()->json([
            'status'        => 'success',
            'message'       => 'تم تسجيل حضور ' . $attending->attendee_name . ' بنجاح!',
            'attendee_name' => $attending->attendee_name,
            'attendee_type' => $attending->attendee_type,
            'time'          => now()->format('H:i d/m/Y'),
            'attending_id'  => $attending->id,
        ]);
    }
}
