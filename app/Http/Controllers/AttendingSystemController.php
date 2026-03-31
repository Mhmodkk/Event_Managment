<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class AttendingSystemController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $requestedTickets = (int) $request->input('num_tickets', 1);

        // التحقق من عدد التذاكر المطلوب
        if ($requestedTickets < 1 || $requestedTickets > 10) {
            return response()->json([
                'status'  => 'error',
                'message' => 'يجب اختيار عدد تذاكر بين 1 و 10'
            ], 422);
        }

        // حساب المقاعد المتبقية
        $bookedCount = $event->attendings()->sum('num_tickets');
        $remaining = $event->num_tickets - $bookedCount;

        if ($remaining < $requestedTickets) {
            return response()->json([
                'status'  => 'error',
                'message' => "لا توجد مقاعد كافية. متبقي فقط {$remaining} مقعد"
            ], 422);
        }

        if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())) {
            return response()->json([
                'status'  => 'error',
                'message' => 'المدراء والمشرفين لا يمكنهم حجز حضور'
            ], 403);
        }

        $newAttending = null;

        if (Auth::check()) {
            $userId = Auth::id();

            if ($event->attendings()->where('user_id', $userId)->exists()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'لقد قمت بالحجز مسبقاً لهذه الفعالية'
                ], 422);
            }

            $newAttending = $event->attendings()->create([
                'user_id'     => $userId,
                'num_tickets' => $requestedTickets,
            ]);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'يجب تسجيل الدخول لحجز متعدد التذاكر'
            ], 403);
        }

        // توليد QR Code
        if ($newAttending) {
            $qrToken = 'attending:' . $newAttending->id;

            $renderer = new ImageRenderer(
                new RendererStyle(400, 2),
                new ImagickImageBackEnd()
            );

            $writer = new Writer($renderer);
            $qrImage = $writer->writeString($qrToken);

            $qrPath = 'qrcodes/attending-' . $newAttending->id . '-' . Str::random(10) . '.png';

            Storage::disk('public')->put($qrPath, $qrImage);

            $newAttending->update([
                'qr_token'        => $qrToken,
                'qr_path'         => $qrPath,
                'qr_generated_at' => now(),
            ]);

            return response()->json([
                'status'            => 'added',
                'message'           => "تم حجز {$requestedTickets} تذكرة بنجاح",
                'remaining_tickets' => $remaining - $requestedTickets,
                'qr_code_url'       => Storage::url($qrPath),
                'qr_token'          => $qrToken,
                'num_tickets'       => $requestedTickets,
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'حدث خطأ أثناء الحجز'
        ], 500);
    }
}
