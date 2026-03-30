<?php

namespace App\Http\Controllers;

use App\Models\Attending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CancelBookingController extends Controller
{
    public function __invoke(Request $request, Attending $attending)
    {
        if ($attending->user_id !== Auth::id()) {
            return response()->json(['error' => 'غير مصرح لك بإلغاء هذا الحجز'], 403);
        }

        if ($attending->event->start_date->subDay()->isPast()) {
            return response()->json(['error' => 'لا يمكن إلغاء الحجز بعد مرور 24 ساعة من بداية الفعالية'], 422);
        }

        $attending->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم إلغاء الحجز بنجاح',
        ]);
    }
}
