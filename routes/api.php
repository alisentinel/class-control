<?php

use App\Http\Controllers\CourseController;
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
Route::middleware('auth:sanctum')->group( function () {
Route::resource('courses', CourseController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('locations', LocationController::class);
Route::resource('sessions', SessionController::class);
Route::resource('university', UniversityController::class);
});

Route::post('register',[SanctumAuthController::class,'register']);
Route::post('login',[SanctumAuthController::class,'login']);
Route::get('logout',[SanctumAuthController::class,'logout'])->middleware('auth:sanctum');