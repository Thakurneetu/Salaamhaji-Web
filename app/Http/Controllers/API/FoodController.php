<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoodMaster;
use App\Models\FoodMenu;
use App\Models\FoodCategory;
use App\Models\FoodCartItem;
use Carbon\Carbon;

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
      $services = FoodMaster::select('id','category_id','name','price','serves','image','thumbnail')->where('category_id', $id)->where('status', 1)->get();
      foreach ($services as $service) {
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
    public function packages(Request $request)
    {
      $packages = FoodMenu::select('id','package')->where('area_id', $request->area_id)->get();
      return response()->json([
        'status' => true,
        'packages' => $packages,
      ]);
    }
    public function menu($id, Request $request)
    {
      $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
      if($request->has('filter') && $request->filter && $request->filter != 'all'){
        $days = array_filter(array_map('trim',explode(',',$request->filter)));
      }
      $foodMenu = FoodMenu::find($id);
      $cards = [];
      $breakfast = $foodMenu->items->where('day','common')->where('meal','breakfast')->first()->meal_items??'';
      $lunch = $foodMenu->items->where('day','common')->where('meal','brelunchakfast')->first()->meal_items??'';
      $dinner = $foodMenu->items->where('day','common')->where('meal','dinner')->first()->meal_items??'';
      foreach($days as $key => $day){
        $cards[$key]['day'] = Carbon::parse($day)->format('D');
        $cards[$key]['breakfast_slot'] = Carbon::parse($foodMenu->breakfast_start)->format(config('constants.TIME')) .'-'. Carbon::parse($foodMenu->breakfast_end)->format(config('constants.TIME'));
        $cards[$key]['lunch_slot'] = Carbon::parse($foodMenu->lunch_start)->format(config('constants.TIME')) .'-'. Carbon::parse($foodMenu->lunch_end)->format(config('constants.TIME'));
        $cards[$key]['dinner_slot'] = Carbon::parse($foodMenu->dinner_start)->format(config('constants.TIME')) .'-'. Carbon::parse($foodMenu->dinner_end)->format(config('constants.TIME'));
        $cards[$key]['breakfast'] = array_filter(array_map('trim',explode(',',$foodMenu->items->where('day',strtolower($day))->where('meal','breakfast')->first()->meal_items))) ?? [];
        if(count($cards[$key]['breakfast']) && $breakfast) {
          $cards[$key]['breakfast'][] = $breakfast;
        }
        $cards[$key]['lunch'] = array_filter(array_map('trim',explode(',',$foodMenu->items->where('day',strtolower($day))->where('meal','lunch')->first()->meal_items))) ?? [];
        if(count($cards[$key]['lunch']) && $lunch) {
          $cards[$key]['lunch'][] = $lunch;
        }
        $cards[$key]['dinner'] = array_filter(array_map('trim',explode(',',$foodMenu->items->where('day',strtolower($day))->where('meal','dinner')->first()->meal_items))) ?? [];
        if(count($cards[$key]['dinner']) && $dinner) {
          $cards[$key]['dinner'][] = $dinner;
        }
      }
      return response()->json([
        'status' => true,
        'menu' => $cards,
      ]);
    }
}
