<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoodMaster;
use App\Models\FoodCategory;
use App\Models\FoodCartItem;

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
    public function services($id, Request $request)
    {
      $services = FoodMaster::select('id','category_id','name','price','serves','image','thumbnail')->where('status', 1)->get();
      foreach ($services as $key => $service) {
        $cart_quantity = FoodCartItem::where([
                          'service_id'=>$service->id, 
                          'customer_id'=>$request->user()->id
                          ])->first();
        $service->cart_quantity = $cart_quantity ? $cart_quantity->quantity : 0;
      }
      return response()->json([
        'status' => true,
        'services' => $services,
      ]);
    }
}
