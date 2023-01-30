<?php

use App\Http\Controllers\CourseController;
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

Route::resource('courses', CourseController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('locations', LocationController::class);
Route::resource('sessions', SessionController::class);
Route::resource('university', UniversityController::class);
