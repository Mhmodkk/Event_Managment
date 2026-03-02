<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\SavedEvent;
use Illuminate\Http\Request;

class SavedEventController extends Controller
{
    /**
     * حفظ فعالية
     */
    public function save(Request $request, Event $event)
    {
        $user = auth()->user();

        $existing = SavedEvent::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'الفعالية محفوظة مسبقًا',
                'saved'   => true
            ], 200);
        }

        $saved = SavedEvent::create([
            'user_id'  => $user->id,
            'event_id' => $event->id,
        ]);

        return response()->json([
            'message' => 'تم حفظ الفعالية',
            'saved'   => true,
        ], 201);
    }

    /**
     * إلغاء حفظ الفعالية
     */
    public function unsave(Request $request, Event $event)
    {
        $deleted = SavedEvent::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->delete();

        if ($deleted === 0) {
            return response()->json([
                'message' => 'لم تكن الفعالية محفوظة أصلاً',
                'saved'   => false
            ], 200);
        }

        return response()->json([
            'message' => 'تم إلغاء الحفظ',
            'saved'   => false,
        ]);
    }

    /**
     * عرض الفعاليات المحفوظة للمستخدم الحالي
     */
    public function mySaved(Request $request)
    {
        $query = SavedEvent::where('user_id', auth()->id())
            ->with([
                'event' => function ($q) {
                    $q->with(['user', 'faculty', 'tags']);
                }
            ])
            ->latest();

        // فلتر اختياري: الفعاليات القادمة فقط
        if ($request->boolean('upcoming')) {
            $query->whereHas('event', function ($q) {
                $q->where('start_date', '>=', now()->toDateString());
            });
        }

        $saved = $query->paginate(10);

        return response()->json([
            'data'         => $saved->items(),
            'current_page' => $saved->currentPage(),
            'last_page'    => $saved->lastPage(),
            'total'        => $saved->total(),
        ]);
    }

    /**
     * التحقق من حالة الحفظ (اختياري)
     */
    public function isSaved(Event $event)
    {
        $saved = SavedEvent::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->exists();

        return response()->json([
            'saved' => $saved,
        ]);
    }
}
