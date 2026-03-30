<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'stars' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($event->ratings()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'لقد قيّمت هذه الفعالية مسبقًا.');
        }

        $event->ratings()->create([
            'user_id' => auth()->id(),
            'stars' => $request->stars,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'شكرًا لتقييمك!');
    }
}
