<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [LoginController::class, 'showLoginForm'])->name('home');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
  Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
  Route::post('/profile', [DashboardController::class, 'profileUpdate']);
  Route::get('/change-password', [DashboardController::class, 'changeForm'])->name('change_password');
  Route::post('/change-password', [DashboardController::class, 'changePassword']);
  Route::resources([
    'job-title' => JobTitleController::class,
  ]);
});