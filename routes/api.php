<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('announcements', [AnnouncementController::class, 'showAnnouncement']);
Route::get('announcements/{announcement}', [AnnouncementController::class, 'oneAnnouncement']);
Route::get('search', [AnnouncementController::class, 'searchAnnouncement']);
Route::get('filter', [AnnouncementController::class, 'filterAnnouncement']);
Route::get('announcements/{announcement}/reviews', [ReviewController::class, 'showReview']);

Route::middleware('auth.local')->group(function (){

    Route::get('logout', [UserController::class, 'logout']);

    Route::prefix('api-service')->group(function(){
        Route::post('announcements', [AnnouncementController::class, 'createAnnouncement']);
        Route::delete('announcements/{announcement}', [AnnouncementController::class, 'deleteAnnouncement']);
        Route::patch('announcements/{announcement}', [AnnouncementController::class, 'updateAnnouncement']);
        Route::patch('announcements/rating/{announcement}', [AnnouncementController::class, 'ratingAnnouncement']);
        Route::post('reviews', [ReviewController::class, 'createReview']);
        Route::delete('reviews/{review}', [ReviewController::class, 'deleteReview']);
        Route::patch('reviews/{review}', [ReviewController::class, 'updateReview']);
        Route::patch('reviews/rating/{review}', [ReviewController::class, 'ratingReview']);
        Route::get('profile/{id}', [UserController::class, 'getProfile']);

    });

});

Route::fallback(function () {
    return response()->json(["message" => "Not Found", "code" => 404], 404);
});

