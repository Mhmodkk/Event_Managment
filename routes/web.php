<?php

use App\Http\Controllers\{
    AttendingEventController,
    AttendingSystemController,
    CancelBookingController,
    DeleteCommentController,
    EventAttendanceController,
    EventController,
    EventIndexController,
    EventScanController,
    EventShowController,
    GalleryController,
    GalleryIndexController,
    InvitationCodeController,
    LikedEventController,
    LikeSystemController,
    MyBookingsController,
    ProfileController,
    RatingController,
    SavedEventController,
    SavedEventSystemController,
    ScanTicketController,
    StoreCommentController,
    SuperAdminDashboardController,
    UserController,
    AdminRegisterController,
    Auth\OtpController,
};
use App\Models\Event;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| المسارات العامة (للجميع)
*/

// الصفحة الرئيسية والفهرس
Route::get('/', [EventController::class, 'welcome'])->name('welcome');
Route::get('/e', EventIndexController::class)->name('eventIndex');
Route::get('/e/{id}', EventShowController::class)->name('eventShow')->whereNumber('id');
Route::get('/gallery', GalleryIndexController::class)->name('galleryIndex');

// التحقق عبر OTP
Route::get('verify-otp', [OtpController::class, 'show'])->name('otp.verify');
Route::post('verify-otp', [OtpController::class, 'verify'])->name('otp.verify.store');

/*
|--------------------------------------------------------------------------
| تسجيل المشرفين (للضيوف فقط - برمز دعوة)
*/
Route::middleware('guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/register', [AdminRegisterController::class, 'create'])->name('register');
    Route::post('/register', [AdminRegisterController::class, 'store'])->name('register.store');
});

/*
|--------------------------------------------------------------------------
| لوحة المدير الأعلى (Super Admin)
*/
Route::middleware(['auth', 'role:super-admin'])->prefix('admin')->name('admin.')->group(function () {
    // إدارة المستخدمين
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.update-role');

    // رموز الدعوة للمشرفين الجدد
    Route::get('/invitation-codes/create', [InvitationCodeController::class, 'create'])->name('invitation-codes.create');
    Route::post('/invitation-codes', [InvitationCodeController::class, 'store'])->name('invitation-codes.store');
    Route::get('/invitation-codes', [InvitationCodeController::class, 'index'])->name('invitation-codes.index');
});

/*
|--------------------------------------------------------------------------
| لوحة التحكم (للجميع بعد تسجيل الدخول)
*/
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $user = auth()->user();
    $myEvents = ($user->isAdmin() || $user->isSuperAdmin())
        ? Event::where('user_id', $user->id)->withCount('attendings')->get()
        : collect();

    return view('dashboard', compact('myEvents'));
})->name('dashboard');


// ==================== تسجيل الحضور العام (عبر QR) ====================
Route::get('/events/attendance/{token}', [EventAttendanceController::class, 'publicShow'])
    ->name('events.attendance.public');
Route::post('/events/attendance/{token}/register', [EventAttendanceController::class, 'publicRegister'])
    ->name('events.attendance.public.register');
/*
|--------------------------------------------------------------------------
| المسارات المحمية (تتطلب تسجيل دخول)
*/
Route::middleware('auth')->group(function () {

    // الملف الشخصي
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    // ==================== إدارة الفعاليات ====================

    // المسارات المخصصة (تُعرف قبل الـ Resource لتجنب التعارض)
    Route::get('/events/{event}/scan', [EventScanController::class, '__invoke'])
        ->name('events.scan')->whereNumber('event');
    Route::post('/events/{event}/scan-ticket', ScanTicketController::class)
        ->name('scan.ticket');
    Route::get('/events/{event}/attendance', EventAttendanceController::class)
        ->name('events.attendance');

    // الـ Resource القياسي (باستثناء show لأننا نستخدم مساراً مخصصاً)
    Route::resource('/events', EventController::class)->except(['show']);

    // ==================== إدارة المعرض ====================
    Route::resource('/galleries', GalleryController::class);

    // ==================== الفعاليات الشخصية ====================
    Route::get('/liked-events', LikedEventController::class)->name('likedEvents');
    Route::get('/saved-events', SavedEventController::class)->name('savedEvents');
    // ✅ تم إصلاح الخطأ الإملائي: attendingEvents بدلاً من attendindEvents
    Route::get('/attending-events', AttendingEventController::class)->name('attendingEvents');

    // ==================== نظام التفاعل ====================
    Route::post('/events-like/{id}', LikeSystemController::class)->name('events.like');
    Route::post('/events-saved/{id}', SavedEventSystemController::class)->name('events.saved');
    Route::post('/events-attending/{id}', AttendingSystemController::class)->name('events.attending');

    // ==================== التعليقات ====================
    Route::post('/events/{id}/comments', StoreCommentController::class)->name('events.comments');
    Route::delete('/events/{id}/comments/{comment}', DeleteCommentController::class)->name('events.comments.destroy');

    // ==================== الحجوزات ====================
    Route::get('/my-bookings', [MyBookingsController::class, 'index'])->name('my.bookings');
    Route::delete('/bookings/{attending}/cancel', CancelBookingController::class)->name('bookings.cancel');

    // ==================== التقييم ====================
    Route::post('/events/{event}/rate', [RatingController::class, 'store'])->name('events.rate');

    // ==================== المسح (للمشرفين فقط) ====================
    Route::middleware('admin')->prefix('scan')->name('scan.')->group(function () {
        Route::get('/', [EventScanController::class, 'index'])->name('index');
        Route::get('/{event}', [EventScanController::class, '__invoke'])->name('event')->whereNumber('event');
    });

    // ==================== لوحة المدير الأعلى (مسار بديل) ====================
    Route::middleware('superadmin')->get('/managment', SuperAdminDashboardController::class)->name('managment');

    // ==================== مسارات مساعدة ====================
    Route::get('/faculties', [EventController::class, 'faculties'])->name('faculties.index');
    Route::get('/event-types', [EventController::class, 'types'])->name('events.types');
    Route::get('/archive', [EventController::class, 'archive'])->name('events.archive');
});

// تحميل مسارات المصادقة (Laravel Breeze/Jetstream)
require __DIR__ . '/auth.php';
