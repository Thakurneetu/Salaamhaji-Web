<?php

namespace App\Http\Controllers\API;

use App\Models\FoodCart;
use App\Models\FoodMaster;
use App\Models\FoodCartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Traits\HelperTrait;

class FoodCartController extends Controller
{
  use HelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $customer_id = $request->user()->id;
      $threshold = Carbon::now()->addHours(24);
      FoodCart::where('customer_id', $customer_id)->where(function ($query) use ($threshold) {
        $query->where('from', '<', $threshold);
      })->delete();
      $carts = FoodCart::where('customer_id', $customer_id)->get();
      $data = $this->foodOrders($carts);
      $subtotal = $data['subtotal'];
      $items = $data['items'];
      $tax = number_format($subtotal * 5 / 100, 2, '.', '');
      $grand_total = number_format($subtotal + ($subtotal * 5 / 100), 2, '.', '');
      return response()->json([
        'status' => true,
        'subtotal' => number_format($subtotal, 2, '.', ''),
        'tax' => $tax,
        'grand_total' => (string) $grand_total,
        'carts' => $items,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $cart_data = $request->only('meal','meal_type','package_id','from','to','quantity');
      $cart_data['customer_id'] = $request->user()->id;
      $cart_data['area_id'] = $request->area_id;
      $cart = FoodCart::updateOrcreate(['customer_id' => $request->user()->id],$cart_data);
      return response()->json([
        'status' => true,
        'message' => 'Item added to cart successfully.',
        'cart_id' => $cart->id
      ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodCart $foodCart)
    {
      return response()->json([
        'status' => true,
        'cart' => $foodCart
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodCart $foodCart)
    {
      $cart_data = $request->only('meal','meal_type','package_id','from','to','quantity');
      $foodCart->update($cart_data);
      return response()->json([
        'status' => true,
        'message' => 'Cart updated successfully.',
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodCart $foodCart)
    {
      $foodCart->delete();
      return response()->json([
        'status' => true,
        'message' => 'Removed from cart successfully.',
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function clear(Request $request)
    {
      FoodCart::where('customer_id',$request->user()->id)->delete();
        return response()->json([
          'status' => true,
          'message' => 'Cart Cleared successfully.',
        ]);
    }
}
