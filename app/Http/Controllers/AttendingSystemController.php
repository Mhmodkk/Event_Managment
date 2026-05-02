<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendingSystemController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $requestedTickets = (int) $request->input('num_tickets', 1);

        // التحقق من عدد التذاكر
        if ($requestedTickets < 1 || $requestedTickets > 10) {
            return response()->json([
                'status'  => 'error',
                'message' => 'يجب اختيار عدد تذاكر بين 1 و 10'
            ], 422);
        }

        // التحقق من المقاعد المتبقية
        $bookedCount = $event->attendings()->sum('num_tickets');
        $remaining = $event->num_tickets - $bookedCount;

        if ($remaining < $requestedTickets) {
            return response()->json([
                'status'  => 'error',
                'message' => "لا توجد مقاعد كافية. متبقي فقط {$remaining} مقعد"
            ], 422);
        }

        // منع المدراء والمشرفين من الحجز
        if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())) {
            return response()->json([
                'status'  => 'error',
                'message' => 'المدراء والمشرفين لا يمكنهم حجز حضور'
            ], 403);
        }

        // يجب أن يكون المستخدم مسجلاً للدخول
        if (!Auth::check()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'يجب تسجيل الدخول لحجز متعدد التذاكر'
            ], 403);
        }

        $userId = Auth::id();

        // منع الحجز المكرر لنفس المستخدم
        if ($event->attendings()->where('user_id', $userId)->exists()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'لقد قمت بالحجز مسبقاً لهذه الفعالية'
            ], 422);
        }

        // إنشاء الحجز
        $newAttending = $event->attendings()->create([
            'user_id'     => $userId,
            'num_tickets' => $requestedTickets,
        ]);

        if ($newAttending) {
            // ✅ إرجاع بيانات الفعالية للمودال
            return response()->json([
                'status'            => 'added',
                'message'           => "تم حجز {$requestedTickets} تذكرة بنجاح",
                'remaining_tickets' => $remaining - $requestedTickets,
                'num_tickets'       => $requestedTickets,
                'event' => [
                    'title'      => $event->title,
                    'location'   => $event->location ?? 'غير محدد',
                    'start_date' => \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i'),
                    'faculty'    => $event->faculty->name ?? 'جامعة الحواش',
                ],
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'حدث خطأ أثناء الحجز'
        ], 500);
    }
}
