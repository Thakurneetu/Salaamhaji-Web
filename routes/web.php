<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\LoundryCategoryController;
use App\Http\Controllers\LoundryMasterController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodMasterController;
use App\Http\Controllers\VendorLaundryServiceController;
use App\Http\Controllers\VendorFoodServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CabController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/home', [LoginController::class, 'showLoginForm']);

Route::get('/', [VendorController::class, 'vendorForm'])->name('vendor.registration');
Route::post('/', [VendorController::class, 'vendorFormSubmit']);
Route::get('/success', [VendorController::class, 'success']);

Route::get('/success', [VendorController::class, 'success']);

Route::group(['middleware' => 'auth'], function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
  Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
  Route::post('/profile', [DashboardController::class, 'profileUpdate']);
  Route::get('/change-password', [DashboardController::class, 'changeForm'])->name('change_password');
  Route::post('/change-password', [DashboardController::class, 'changePassword']);
  Route::resources([
    'customer' => CustomerController::class,
    'vendor-users' => VendorController::class,
    'banner' => BannerController::class,
    'laundry_category' => LoundryCategoryController::class,
    'laundry_master' => LoundryMasterController::class,
    'food_category' => FoodCategoryController::class,
    'food_master' => FoodMasterController::class,
    'vendor-laundry-service' => VendorLaundryServiceController::class,
    'vendor-food-service' => VendorFoodServiceController::class,
    'order' => OrderController::class,
    'location' => LocationController::class,
    'cab' => CabController::class,
  ]);
});