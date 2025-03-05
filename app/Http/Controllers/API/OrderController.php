<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\LaundryCart;
use App\Models\LoundryMaster;
use App\Models\LaundryCartItem;
use App\Models\FoodCart;
use App\Models\FoodMaster;
use App\Models\FoodCartItem;
use App\Models\FoodOrderItem;
use App\Models\LaundryOrder;
use App\Models\LaundryOrderItem;
use App\Models\CabCart;
use App\Models\CabOrder;
use App\Traits\HelperTrait;

class OrderController extends Controller
{
  use HelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::where('customer_id', $request->user()->id)->get();
        return response()->json([
          'status' => true,
          'orders' => $this->formatOrders($orders)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = $request->type;
        $cart_id = $request->cart_id;
        $order_data['uuid'] = $this->generateUniqueOrderId();
        $order_data['customer_id'] = $request->user()->id;
        $order_data['type'] = $type;
        $order_data['address_line_1'] = $request->address_line_1;
        $order_data['address_line_2'] = $request->address_line_2;
        $order_data['landmark'] = $request->landmark;
        if($type == 'food'){
          $cart = FoodCart::where('customer_id', $request->user()->id)->first();
          $order_data['subtotal'] = number_format($cart->sum('total'), 2);
          $order_data['tax'] = number_format($cart->sum('total') * 5 / 100, 2);
          $order_data['grand_total'] = number_format($order_data['subtotal'] + $order_data['tax'], 2);
          $order_data['service_date'] = $cart->service_date;
          $order_data['start'] = $cart->start;
          $order_data['end'] = $cart->end;
          $order_data['status'] = 'Active';
          // $order_data['payment_id'] = '';
          // $order_data['payment_status'] = '';
          // $order_data['payment_type'] = '';
          $order = Order::create($order_data);
          $item_data['order_id'] = $order->id;
          $item_data['customer_id'] = $request->user()->id;
          foreach ($cart->items as $key => $item) {
            $item_data['category_name'] = $item->category_name;
            $item_data['service_name'] = $item->service_name;
            $item_data['price_per_piece'] = $item->price_per_piece;
            $item_data['quantity'] = $item->quantity;
            $item_data['total_price'] = $item->total_price;
            FoodOrderItem::create($item_data);
          }
          $ids = FoodCart::where('customer_id',$request->user()->id)->pluck('id');
          FoodCartItem::whereIn('food_cart_id', $ids)->delete();
          FoodCart::where('customer_id',$request->user()->id)->delete();
          return response()->json([
            'status' => true,
            'message' => 'Order Placed Successfully',
          ]);
        }else if($type == 'laundry'){
          $carts = LaundryCart::where('customer_id', $request->user()->id)->with('items')->get();
          $order_data['subtotal'] = number_format($carts->sum('total'), 2);
          $order_data['tax'] = number_format($carts->sum('total') * 5 / 100, 2);
          $order_data['grand_total'] = number_format($order_data['subtotal'] + $order_data['tax'], 2);
          $order_data['status'] = 'Active';
          $order_data['service_date'] = $carts->first()->service_date;
          $order_data['start'] = $carts->first()->start;
          $order_data['end'] = $carts->first()->end;
          // $order_data['payment_id'] = '';
          // $order_data['payment_status'] = '';
          // $order_data['payment_type'] = '';
          $order = Order::create($order_data);
          $laundry_order_data['order_id'] = $order->id;
          $laundry_order_data['customer_id'] = $request->user()->id;
          foreach ($carts as $key => $cart) {
            $laundry_order_data['category_name'] = $cart->category_name;
            $laundry_order_data['total'] = $cart->total;
            $laundry_order_data['status'] = 'Active';
            $laundry_order = LaundryOrder::create($laundry_order_data);
            $item_data['laundry_order_id'] = $laundry_order->id;
            foreach ($cart->items as $key => $item) {
              $item_data['service_name'] = $item->service_name;
              $item_data['price_per_piece'] = $item->price_per_piece;
              $item_data['quantity'] = $item->quantity;
              $item_data['total_price'] = $item->total_price;
              LaundryOrderItem::create($item_data);
            }
          }
          $ids = LaundryCart::where('customer_id',$request->user()->id)->pluck('id');
          LaundryCartItem::whereIn('laundry_cart_id', $ids)->delete();
          LaundryCart::where('customer_id',$request->user()->id)->delete();
          return response()->json([
            'status' => true,
            'message' => 'Order Placed Successfully',
          ]);
        }else if($type == 'cab') {
          $cart = CabCart::where('customer_id', $request->user()->id)->latest()->first();
          $subtotal = $cart->tour_type == 'local' ? ($cart->hours * $cart->fare->price) : $cart->fare->price;
          $order_data['subtotal'] = number_format($subtotal, 2);
          $order_data['tax'] = number_format($subtotal * 5 / 100, 2);
          $order_data['grand_total'] = number_format($order_data['subtotal'] + $order_data['tax'], 2);
          $order_data['status'] = 'Active';
          $order_data['service_date'] = $cart->service_date;
          $order_data['start'] = $cart->start;
          $order_data['end'] = $cart->end;
          $order = Order::create($order_data);

          $cab_data['order_id'] = $order->id;
          $cab_data['customer_id'] = $request->user()->id;
          $cab_data['tour_type'] = $cart->tour_type;
          $cab_data['hours'] = $cart->hours;
          $cab_data['price'] = $cart->fare->price;
          $cab_data['origin'] = $cart->tour_type == 'local' 
                                  ? $cart->fare->origin->name 
                                  : $cart->fare->outstation->origin->name;
          $cab_data['destination'] = $cart->tour_type == 'local' ? '' : $cart->fare->outstation->destination->name;
          $cab_data['pickup_location'] = $cart->pickup_location;
          $cab_data['instruction'] = $cart->instruction;
          $cab_data['cab_type'] = $cart->fare->cab->type;
          $cab_data['seats'] = $cart->fare->cab->seats;
          $cab_data['luggage'] = $cart->fare->cab->luggage;
          CabOrder::create($cab_data);
          CabCart::where('customer_id', $request->user()->id)->delete();
          return response()->json([
            'status' => true,
            'message' => 'CAB Booked Successfully',
          ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
      return response()->json([
        'status' => true,
        'order' => $order
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
