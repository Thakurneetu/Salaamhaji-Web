<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\API\LaundryController;
use App\Http\Controllers\API\CustomerAuthController;
use App\Http\Controllers\API\LaundryCartController;
use App\Http\Controllers\API\FoodCartController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\FamilyController;
use App\Http\Controllers\API\CabController;
use App\Http\Controllers\API\CabCartController;
use App\Http\Controllers\API\NotificationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CustomerAuthController::class)->group(function(){
  Route::post('/login', 'login');
  Route::post('/register', 'register');
  Route::post('/send-otp', 'send_otp');
  Route::post('/verify-otp', 'verify_otp');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
    Route::post('/profile', [CustomerAuthController::class, 'profile']);
    Route::post('/location', [CustomerAuthController::class, 'location']);
    Route::controller(HomeController::class)->group(function(){
      Route::get('/home-page', 'home');
      Route::get('/banners', 'banners');
    });
    Route::controller(FoodController::class)->group(function(){
      Route::get('/food/categories', 'categories');
      Route::get('/food/category-services/{id}', 'services');
      Route::get('/food/packages', 'packages');
      Route::get('/food/menu/{id}', 'menu');
    });
    Route::controller(LaundryController::class)->group(function(){
      Route::get('laundry/categories', 'categories');
      Route::get('laundry/category-services/{id}', 'services');
    });
    Route::prefix('transport')->controller(CabController::class)->group(function(){
      Route::get('/locations', 'locations');
      Route::get('/local-fares', 'local_fares');
      Route::get('/outstation-fares/{origin}/{destination}', 'outstation_fares');
    });

    Route::apiResource('laundry-cart', LaundryCartController::class);
    Route::get('clear-laundry-cart', [LaundryCartController::class, 'clear']);

    Route::apiResource('food-cart', FoodCartController::class);
    Route::get('clear-food-cart', [FoodCartController::class, 'clear']);

    Route::apiResource('order', OrderController::class);

    Route::apiResource('family', FamilyController::class);
    Route::apiResource('notification', NotificationController::class);

    Route::apiResource('cab-cart', CabCartController::class);
    Route::get('clear-cab-cart', [CabCartController::class, 'clear']);

    Route::get('notice/{module}', [HomeController::class, 'notice']);

    Route::get('area-list', [HomeController::class, 'areas']);

});

