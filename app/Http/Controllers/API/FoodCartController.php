<?php

namespace App\Http\Controllers\API;

use App\Models\FoodCart;
use App\Models\FoodMaster;
use App\Models\FoodCartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $customer_id = $request->user()->id;
      $cart = FoodCart::select('id','total','service_date','start','end')
               ->with('items:id,food_cart_id,service_id,price_per_piece,quantity,total_price')
               ->where('customer_id', $customer_id)
               ->first();
      $subtotal = $cart ? number_format($cart->sum('total'), 2) : '0.00';
      $tax = $cart ? number_format($cart->sum('total') * 5 / 100, 2) : '0.00';
      $grand_total = $cart ? number_format($subtotal + $tax, 2) : '0.00';
      return response()->json([
        'status' => true,
        'subtotal' => $subtotal,
        'tax' => $tax,
        'grand_total' => (string) $grand_total,
        'cart' => $cart,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $cart_data['customer_id'] = $request->user()->id;

      $cart = FoodCart::where($cart_data)->first();
      if(!$cart){
        $cart = FoodCart::create($cart_data);
      }

      $service = FoodMaster::find($request->service_id);
      $item = [
        'food_cart_id' => $cart->id,
        'service_id' => $service->id,
        'category_id' => $request->category_id,
        'customer_id' => $request->user()->id
      ];
      if($request->quantity > 0){
        FoodCartItem::updateOrCreate($item,[
          'price_per_piece' => $service->price,
          'quantity' => $request->quantity,
          'total_price' => number_format($service->price * $request->quantity, 2)
        ]);
        $cart->total = FoodCartItem::where('food_cart_id', $cart->id)->sum('total_price');
        $cart->save();
        return response()->json([
          'status' => true,
          'message' => 'Item added to cart successfully.',
          'cart_id' => $cart->id
        ]);
      }else{
        FoodCartItem::where($item)->delete();
        $cart_items = FoodCartItem::where('food_cart_id', $cart->id)->count();
        if($cart_items == 0){
          $cart->delete();
        }else{
          $cart->total = FoodCartItem::where('food_cart_id', $cart->id)->sum('total_price');
          $cart->save();
        }
        return response()->json([
          'status' => true,
          'message' => 'Item removed from cart successfully.',
        ]);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodCart $foodCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodCart $foodCart)
    {
      $cart_data = $request->only('service_date', 'start','end');
      $foodCart->update($cart_data);
      return response()->json([
        'status' => true,
        'message' => 'Service slot added successfully.',
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodCart $foodCart)
    {
      $foodCart->items()->delete();
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
      $ids = FoodCart::where('customer_id',$request->user()->id)->pluck('id');
      FoodCartItem::whereIn('laundry_cart_id', $ids)->delete();
      FoodCart::where('customer_id',$request->user()->id)->delete();
        return response()->json([
          'status' => true,
          'message' => 'Cart Cleared successfully.',
        ]);
    }
}
