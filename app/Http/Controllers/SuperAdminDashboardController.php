<?php

namespace App\Http\Controllers;

use App\Models\Attending;
use App\Models\Event;
use App\Models\User;

class SuperAdminDashboardController extends Controller
{
    public function __invoke()
    {
        $totalEvents = Event::count();
        $totalBookings = Attending::count();
        $attendedCount = Attending::whereNotNull('attended_at')->count();

        $attendanceRate = $totalBookings > 0
            ? round(($attendedCount / $totalBookings) * 100, 1)
            : 0;

        $allEvents = Event::withCount('attendings')
            ->orderBy('start_date', 'desc')
            ->get();

        $topFaculties = Event::withCount('attendings')
            ->orderBy('attendings_count', 'desc')
            ->take(5)
            ->get()
            ->map(fn($event) => [
                'faculty' => $event->faculty->name ?? 'غير محدد',
                'bookings' => $event->attendings_count,
            ]);

        $recentUsers = User::latest()->take(5)->get();
        $users = User::latest()->paginate(15);
        $totalUsers = User::count();

        return view('super-dashboard', compact(
            'totalEvents',
            'totalBookings',
            'attendedCount',
            'attendanceRate',
            'allEvents',
            'topFaculties',
            'recentUsers',
            'users',
            'totalUsers'
        ));
    }
}
