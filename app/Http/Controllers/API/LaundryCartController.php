<?php

namespace App\Http\Controllers\API;

use App\Models\LaundryCart;
use App\Models\LoundryMaster;
use App\Models\LaundryCartItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaundryCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $customer_id = $request->user()->id;
      $carts = LaundryCart::select('id', 'category_id','total','service_date','start','end')
               ->with('items:id,laundry_cart_id,service_id,price_per_piece,quantity,total_price')
               ->where('customer_id', $customer_id)
               ->get();
      $subtotal = number_format($carts->sum('total'), 2);
      $tax = number_format($carts->sum('total') * 5 / 100, 2);
      return response()->json([
        'status' => true,
        'subtotal' => $subtotal,
        'tax' => $tax,
        'grand_total' => (string) number_format($subtotal + $tax, 2),
        'cart' => $carts,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $cart_data['customer_id'] = $request->user()->id;
      $cart_data['category_id'] = $request->category_id;

      $cart = LaundryCart::where($cart_data)->first();
      if(!$cart){
        $cart = LaundryCart::create($cart_data);
      }

      $service = LoundryMaster::find($request->service_id);
      $item = [
        'laundry_cart_id' => $cart->id,
        'service_id' => $service->id
      ];
      if($request->quantity > 0){
        LaundryCartItem::updateOrCreate($item,[
          'price_per_piece' => $service->price,
          'quantity' => $request->quantity,
          'total_price' => number_format($service->price * $request->quantity, 2)
        ]);
        $cart->total = LaundryCartItem::where('laundry_cart_id', $cart->id)->sum('total_price');
        $cart->save();
        return response()->json([
          'status' => true,
          'message' => 'Item added to cart successfully.',
          'cart_id' => $cart->id
        ]);
      }else{
        LaundryCartItem::where($item)->delete();
        $cart_items = LaundryCartItem::where('laundry_cart_id', $cart->id)->count();
        if($cart_items == 0){
          $cart->delete();
        }else{
          $cart->total = LaundryCartItem::where('laundry_cart_id', $cart->id)->sum('total_price');
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
    public function show(LaundryCart $laundryCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaundryCart $laundryCart)
    {
        $cart_data = $request->only('service_date', 'start','end');
        $laundryCart->update($cart_data);
        return response()->json([
          'status' => true,
          'message' => 'Service slot added successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaundryCart $laundryCart)
    {
        $laundryCart->items()->delete();
        $laundryCart->delete();
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
      $ids = LaundryCart::where('customer_id',$request->user()->id)->pluck('id');
      LaundryCartItem::whereIn('laundry_cart_id', $ids)->delete();
      LaundryCart::where('customer_id',$request->user()->id)->delete();
        return response()->json([
          'status' => true,
          'message' => 'Cart Cleared successfully.',
        ]);
    }
}
