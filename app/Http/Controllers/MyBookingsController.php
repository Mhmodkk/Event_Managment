<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MyBookingsController extends Controller
{
    public function index(): View
    {
        $bookings = Auth::user()->attendings()
            ->with(['event' => function ($query) {
                $query->with(['faculty']);
            }])
            ->latest()
            ->get();

        return view('bookings.my-bookings', compact('bookings'));
    }
}
