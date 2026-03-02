<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * إعجاب بفعالية
     */
    public function like(Request $request, Event $event)
    {
        $user = auth()->user();

        // منع الإعجاب المتكرر
        $existing = Like::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'تم الإعجاب مسبقًا',
                'liked'   => true
            ], 200);
        }

        $like = Like::create([
            'user_id'  => $user->id,
            'event_id' => $event->id,
        ]);

        return response()->json([
            'message' => 'تم الإعجاب بالفعالية',
            'liked'   => true,
            'likes_count' => $event->likes()->count(),
        ], 201);
    }

    /**
     * إلغاء الإعجاب
     */
    public function unlike(Request $request, Event $event)
    {
        $deleted = Like::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->delete();

        if ($deleted === 0) {
            return response()->json([
                'message' => 'لم يكن هناك إعجاب أصلاً',
                'liked'   => false
            ], 200);
        }

        return response()->json([
            'message'     => 'تم إلغاء الإعجاب',
            'liked'       => false,
            'likes_count' => $event->likes()->count(),
        ]);
    }

    /**
     * التحقق من حالة الإعجاب (اختياري - مفيد للـ frontend)
     */
    public function isLiked(Event $event)
    {
        $liked = Like::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->exists();

        return response()->json([
            'liked'       => $liked,
            'likes_count' => $event->likes()->count(),
        ]);
    }
}
