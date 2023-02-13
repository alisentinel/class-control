<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\sanctum\SanctumAuthController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::resources([
        'courses' => CourseController::class,
        'teachers' => TeacherController::class,
        'locations' => LocationController::class,
        'sessions' => SessionController::class,
        'universities' => UniversityController::class,
    ]);


    // Route::post('upload', [ExcelController::class, 'import']);
});

Route::post('register', [SanctumAuthController::class, 'register']);
Route::post('login', [SanctumAuthController::class, 'login']);
Route::get('logout', [SanctumAuthController::class, 'logout'])->middleware('auth:sanctum');


Route::any('{path}', function () {
    return response()->json([
        'message' => 'Route not found'
    ], 404);
})->where('path', '.*');
