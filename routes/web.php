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
use App\Http\Controllers\LocalFareController;
use App\Http\Controllers\OutstationController;
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\VendorLocalFareController;
use App\Http\Controllers\VendorOutstationController;

Auth::routes(['register' => false]);

Route::get('/home', [LoginController::class, 'showLoginForm']);

Route::get('/', [VendorController::class, 'vendorForm'])->name('vendor.registration');
Route::post('/', [VendorController::class, 'vendorFormSubmit']);
Route::get('/success', [VendorController::class, 'success']);

Route::get('/success', [VendorController::class, 'success']);

Route::get('/demo', [FoodMasterController::class, 'demo']);

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
    'food-menu' => FoodMenuController::class,
    'vendor-laundry-service' => VendorLaundryServiceController::class,
    'vendor-food-service' => VendorFoodServiceController::class,
    'vendor-local-service' => VendorLocalFareController::class,
    'vendor-outstation-service' => VendorOutstationController::class,
    'order' => OrderController::class,
    'location' => LocationController::class,
    'cab' => CabController::class,
    'local-fare' => LocalFareController::class,
    'outstation-fare' => OutstationController::class,
    'notice' => NoticeController::class,
  ]);
});
