<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoodMaster;
use App\Models\FoodCategory;

class FoodController extends Controller
{
    public function categories()
    {
      $categories = FoodCategory::select('id', 'name')->where('status', 1)->get();
      return response()->json([
        'status' => true,
        'categories' => $categories,
      ]);
    }
    public function services($id)
    {
      $services = FoodMaster::select('id', 'name','price','serves')->where('status', 1)->get();
      return response()->json([
        'status' => true,
        'services' => $services,
      ]);
    }
}
