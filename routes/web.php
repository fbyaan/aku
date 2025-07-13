<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutScheduleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/olahraga', function () {
    return view('pages.olahraga');
});


Route::get('/team', function () {
    return view('pages.team');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/jadwal', [WorkoutScheduleController::class, 'index'])->name('jadwal');
    Route::get('/jadwal/api', [WorkoutScheduleController::class, 'jadwalapi'])->name('jadwalapi');
    Route::post('/workouts', [WorkoutScheduleController::class, 'store'])->name('workouts.store');
    Route::get('/workouts/{workout}', [WorkoutScheduleController::class, 'show'])->name('workouts.show');
    Route::put('/workouts/{workout}', [WorkoutScheduleController::class, 'update'])->name('workouts.update');
    Route::delete('/workouts/{workout}', [WorkoutScheduleController::class, 'destroy'])->name('workouts.destroy');
});


Route::get('/team', function () {
    return view('pages.team');
});




// 

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
