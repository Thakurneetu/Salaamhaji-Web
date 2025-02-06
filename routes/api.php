<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\API\LaundryController;
use App\Http\Controllers\API\CustomerAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CustomerAuthController::class)->group(function(){
  Route::post('/login', 'login');
  Route::post('/register', 'register');
  Route::post('/send-otp', 'send_otp');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
    Route::post('/profile', [CustomerAuthController::class, 'profile']);
    Route::controller(HomeController::class)->group(function(){
      Route::get('/banners', 'banners');
    });
    Route::controller(FoodController::class)->group(function(){
      Route::get('/food/categories', 'categories');
      Route::get('/food/category-services/{id}', 'services');
    });
    Route::controller(LaundryController::class)->group(function(){
      Route::get('laundry/categories', 'categories');
      Route::get('laundry/category-services/{id}', 'services');
    });
});

