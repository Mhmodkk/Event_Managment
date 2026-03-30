<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventShowController extends Controller
{
    public function __invoke($id)
    {
        $event = Event::with(['faculty', 'tags', 'user', 'comments.user'])->findOrFail($id);

        $like = null;
        $savedEvent = null;
        $attending = null;
        $qrCodeUrl = null;
        $qrToken = null;

        if (auth()->check()) {
            $like = $event->likes()->where('user_id', auth()->id())->first();
            $savedEvent = $event->savedEvents()->where('user_id', auth()->id())->first();

            $attending = $event->attendings()
                ->where('user_id', auth()->id())
                ->latest('created_at')
                ->first();

            if ($attending) {
                if ($attending->qr_path) {
                    $qrCodeUrl = Storage::url($attending->qr_path);
                    $qrToken = $attending->qr_token;
                }
            }
        }

        return view('eventsShow', compact(
            'event',
            'like',
            'savedEvent',
            'attending',
            'qrCodeUrl',
            'qrToken'
        ));
    }
}
