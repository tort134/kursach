<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth.local')->group(function (){

    Route::get('logout', [UserController::class, 'logout']);

    Route::prefix('api-service')->group(function(){
        Route::get('announcements', [AnnouncementController::class, 'showAnnouncement']);
        Route::get('announcements/{announcement}', [AnnouncementController::class, 'oneAnnouncement']);
        Route::post('announcements', [AnnouncementController::class, 'createAnnouncement']);
        Route::delete('announcements/{announcement}', [AnnouncementController::class, 'deleteAnnouncement']);
        Route::patch('announcements/{announcement}', [AnnouncementController::class, 'updateAnnouncement']);
        Route::patch('announcements/rating/{announcement}', [AnnouncementController::class, 'ratingAnnouncement']);
        Route::get('search', [AnnouncementController::class, 'searchAnnouncement']);
        Route::get('filter', [AnnouncementController::class, 'filterAnnouncement']);
        Route::get('reviews', [ReviewController::class, 'showReview']);
        Route::post('reviews', [ReviewController::class, 'createReview']);
        Route::delete('reviews/{rewiew}', [ReviewController::class, 'deleteReview']);
        Route::patch('reviews/{rewiew}', [ReviewController::class, 'updateReview']);
        Route::patch('reviews/{rewiew}', [ReviewController::class, 'ratingReview']);
        Route::get('profile/{id}', [UserController::class, 'getProfile']);
    });

});

Route::fallback(function () {
    return response()->json(["message" => "Not Found", "code" => 404], 404);
});

