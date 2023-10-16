<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LocationController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Маршруты для студентов
Route::resource('students', StudentController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'students.index',
        'show' => 'students.show',
        'store' => 'students.store',
        'update' => 'students.update',
        'destroy' => 'students.destroy',
    ]);

// Маршруты для классов
Route::get('classes/{class}/study-plan', [ClassesController::class, 'getStudyPlan'])->name('classes.study-plan');
Route::put('classes/{class}/study-plan', [ClassesController::class, 'updateStudyPlan'])->name('classes.update-study-plan');

Route::resource('classes', ClassesController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'classes.index',
        'show' => 'classes.show',
        'store' => 'classes.store',
        'update' => 'classes.update',
        'destroy' => 'classes.destroy',
    ]);

// Маршруты для лекций
Route::resource('lectures', LectureController::class)
    ->except(['create', 'edit'])
    ->names([
        'index' => 'lectures.index',
        'show' => 'lectures.show',
        'store' => 'lectures.store',
        'update' => 'lectures.update',
        'destroy' => 'lectures.destroy',
    ]);
