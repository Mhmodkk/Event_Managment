<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendingController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\SavedEventController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\GalleryIndexController;
use App\Http\Controllers\Api\ProfileController;

Route::prefix('v1')->group(function () {


    Route::get('/events',           [EventController::class, 'index'])
        ->name('api.events.index');

    Route::get('/events/{event}',   [EventController::class, 'show'])
        ->name('api.events.show');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('api.auth.register');

    Route::post('/login',    [AuthController::class, 'login'])
        ->name('api.auth.login');


    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('api.auth.logout');


        Route::middleware('organizer')->group(function () {

            // Event CRUD (إنشاء / تعديل / حذف)
            Route::post('/events', [EventController::class, 'store'])
                ->name('api.events.store');

            Route::put('/events/{event}', [EventController::class, 'update'])
                ->name('api.events.update');

            Route::delete('/events/{event}', [EventController::class, 'destroy'])
                ->name('api.events.destroy');

            // عرض الحاضرين (attendees) للفعالية
            Route::get('/events/{event}/attendees', [AttendingController::class, 'attendees'])
                ->name('api.events.attendees');
        });


        // Attendance / الحجز والحضور
        Route::post('/events/{event}/attend',   [AttendingController::class, 'attend'])
            ->name('api.attend.store');

        Route::delete('/events/{event}/attend', [AttendingController::class, 'cancel'])
            ->name('api.attend.cancel');

        Route::get('/my-attendings',            [AttendingController::class, 'myAttendings'])
            ->name('api.attend.my');

        // Likes / الإعجاب
        Route::post('/events/{event}/like',     [LikeController::class, 'like'])
            ->name('api.like.store');

        Route::delete('/events/{event}/like',   [LikeController::class, 'unlike'])
            ->name('api.like.destroy');

        Route::get('/events/{event}/is-liked',  [LikeController::class, 'isLiked'])
            ->name('api.like.status');

        // Saved / الحفظ (المفضلة)
        Route::post('/events/{event}/save',     [SavedEventController::class, 'save'])
            ->name('api.saved.store');

        Route::delete('/events/{event}/save',   [SavedEventController::class, 'unsave'])
            ->name('api.saved.destroy');

        Route::get('/events/{event}/is-saved',  [SavedEventController::class, 'isSaved'])
            ->name('api.saved.status');

        Route::get('/my-saved',                 [SavedEventController::class, 'mySaved'])
            ->name('api.saved.my');

        // Comments / التعليقات
        Route::post('/events/{event}/comments',       [CommentController::class, 'store'])
            ->name('api.comments.store');

        Route::get('/events/{event}/comments',        [CommentController::class, 'index'])
            ->name('api.comments.index');

        Route::put('/comments/{comment}',             [CommentController::class, 'update'])
            ->name('api.comments.update');

        Route::delete('/comments/{comment}',          [CommentController::class, 'destroy'])
            ->name('api.comments.destroy');

        Route::get('/events/{event}/comments-count',  [CommentController::class, 'count'])
            ->name('api.comments.count');

        //Profile
        Route::get('/profile', [ProfileController::class, 'show']);
        Route::put('/profile', [ProfileController::class, 'update']);
        Route::post('/profile/image', [ProfileController::class, 'uploadimage']);
        Route::delete('/profile/image', [ProfileController::class, 'deleteimage']);

        // Gallery
        Route::get('/galleries', GalleryIndexController::class);
        Route::get('/events/{event}/galleries', [GalleryController::class, 'index']);
        Route::post('/events/{event}/galleries', [GalleryController::class, 'store']);
        Route::get('/galleries/{gallery}', [GalleryController::class, 'show']);
        Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy']);
    });
});
