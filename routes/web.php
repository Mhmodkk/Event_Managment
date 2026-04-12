<?php

use App\Http\Controllers\AttendingEventController;
use App\Http\Controllers\AttendingSystemController;
use App\Http\Controllers\CancelBookingController;
use App\Http\Controllers\DeleteCommentController;
use App\Http\Controllers\EventAttendanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventIndexController;
use App\Http\Controllers\EventScanController;
use App\Http\Controllers\EventShowController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryIndexController;
use App\Http\Controllers\LikedEventController;
use App\Http\Controllers\LikeSystemController;
use App\Http\Controllers\MyBookingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SavedEventController;
use App\Http\Controllers\SavedEventSystemController;
use App\Http\Controllers\ScanTicketController;
use App\Http\Controllers\StoreCommentController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\OtpController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');
Route::get('/e', EventIndexController::class)->name('eventIndex');
Route::get('/e/{id}', EventShowController::class)->name('eventShow');
Route::get('/gallery', GalleryIndexController::class)->name('galleryIndex');

Route::get('verify-otp', [OtpController::class, 'show'])->name('otp.verify');
Route::post('verify-otp', [OtpController::class, 'verify']);

Route::middleware(['auth', 'superadmin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.update-role');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    $myEvents = ($user->isAdmin() || $user->isSuperAdmin())
        ? Event::where('user_id', $user->id)->withCount('attendings')->get()
        : collect();

    return view('dashboard', compact('myEvents'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->post('/events/{event}/scan-ticket', ScanTicketController::class)
    ->name('events.scan.ticket');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth', 'superadmin'])->get('/super-dashboard', SuperAdminDashboardController::class)->name('super.dashboard');
    Route::middleware(['auth', 'superadmin'])->get('/users', [UserController::class, 'index'])->name('users.index');

    Route::resource('/events', EventController::class);
    Route::resource('/galleries', GalleryController::class);

    Route::get('/liked-events', LikedEventController::class)->name('likedEvents');
    Route::get('/saved-events', SavedEventController::class)->name('savedEvents');
    Route::get('/attendind-events', AttendingEventController::class)->name('attendingEvents');

    Route::post('/events-like/{id}', LikeSystemController::class)->name('events.like');
    Route::post('/events-saved/{id}', SavedEventSystemController::class)->name('events.saved');
    Route::post('/events-attending/{id}', AttendingSystemController::class)->name('events.attending');

    Route::post('/events/{id}/comments', StoreCommentController::class)->name('events.comments');
    Route::delete('/events/{id}/comments/{comment}', DeleteCommentController::class)->name('events.comments.destroy');

    Route::get('/events/{event}/scan', EventScanController::class)->name('events.scan')->whereNumber('event');
    Route::post('/events/{event}/scan', ScanTicketController::class)->name('scan.ticket');
    Route::get('/events/{event}/attendance', EventAttendanceController::class)->name('events.attendance');

    Route::middleware('auth')->get('/my-bookings', [MyBookingsController::class, 'index'])->name('my.bookings');

    Route::middleware(['auth', 'superadmin'])->get('/managment', SuperAdminDashboardController::class)
        ->name('managment');
    Route::middleware(['auth', 'admin'])->get('/scan', [EventScanController::class, 'index'])
        ->name('scan');

    Route::middleware(['auth', 'admin'])->get('/scan/{event}', [EventScanController::class, '__invoke'])
        ->name('scan.event');

    Route::middleware('auth')->delete('/bookings/{attending}/cancel', [CancelBookingController::class, '__invoke'])->name('bookings.cancel');
    Route::middleware('auth')->post('/events/{event}/rate', [RatingController::class, 'store'])->name('events.rate');
});

require __DIR__ . '/auth.php';
