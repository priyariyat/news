<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\PasswordController;

/*
|---------------------------------------------------------------------------
| API Routes
|---------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route to get the authenticated user's information
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Registration and Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Logout Route (requires authentication)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Password Reset Routes
Route::post('/password/email', [PasswordController::class, 'sendResetLinkEmail']); // Send password reset link
Route::post('/password/reset', [PasswordController::class, 'reset']); // Reset the password using the token

// Article Management Routes
Route::get('/articles', [ArticleController::class, 'index']); // Get a list of articles
Route::get('/articles/{id}', [ArticleController::class, 'show']); // Get a single article by ID

// User Preferences Routes (requires authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/preferences', [UserPreferenceController::class, 'store']); // Set user preferences
    Route::get('/feed', [UserPreferenceController::class, 'personalizedFeed']); // Get personalized news feed
});
