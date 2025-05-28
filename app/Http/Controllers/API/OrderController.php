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
use App\Models\FoodOrder;
use App\Models\FoodOrderItem;
use App\Models\LaundryOrder;
use App\Models\LaundryOrderItem;
use App\Models\CabCart;
use App\Models\CabOrder;
use App\Traits\HelperTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
  use HelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::where('customer_id', $request->user()->id)->latest()->get();
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
      try{
        DB::beginTransaction();
        $message = 'Please select a service to continue.';
        $type = $request->type;
        $order_data['uuid'] = $this->generateUniqueOrderId();
        $order_data['customer_id'] = $request->user()->id;
        $order_data['type'] = $type;
        $order_data['address_line_1'] = $request->address_line_1;
        $order_data['address_line_2'] = $request->address_line_2;
        $order_data['landmark'] = $request->landmark;
        $order_data['status'] = 'Order accepted';
        $order_data['payment_type'] = $request->payment_type;
        $order_data['payment_id'] = $request->payment_id;
        $order_data['payment_status'] = $request->payment_status;
        if($type == 'food'){
          $carts = FoodCart::where('customer_id', $request->user()->id)->get();
          if(count($carts) < 1) {
            return response()->json([
              'status' => false,
              'message' => $message,
            ]);
          }
          foreach ($carts as $cart) {
            $order_data['subtotal'] = $this->getFoodSubtotal($cart);
            $order_data['tax'] = $order_data['subtotal'] * 5 / 100;
            $order_data['grand_total'] = $order_data['subtotal'] + ($order_data['subtotal'] * 5 / 100);
            $order_data['area_id'] = $cart->area_id;
            $order = Order::create($order_data);
            $food_data['customer_id'] = $request->user()->id;
            $food_data['order_id'] = $order->id;
            $food_data['package'] = $cart->package->package;
            $food_data['meal'] = $cart->meal;
            $food_data['meal_type'] = $cart->meal_type;
            $food_data['from'] = $cart->from;
            $food_data['to'] = $cart->to ?? $cart->from;
            $food_data['quantity'] = $cart->quantity;
            $food_data['price'] = $order_data['subtotal'] / $cart->quantity;
            $food_data['total'] = $order_data['subtotal'];
            $food_data['breakfast_start'] = $cart->package->breakfast_start;
            $food_data['breakfast_end'] = $cart->package->breakfast_end;
            $food_data['lunch_start'] = $cart->package->lunch_start;
            $food_data['lunch_end'] = $cart->package->lunch_end;
            $food_data['dinner_start'] = $cart->package->dinner_start;
            $food_data['dinner_end'] = $cart->package->dinner_end;
            $food_order = FoodOrder::create($food_data);

            $startDate = Carbon::parse($cart->from);
            $endDate = $cart->to ? Carbon::parse($cart->to) : Carbon::parse($cart->from);
            $dates=[];

            $meals = $this->getFoodMeals($cart);

            while ($startDate <= $endDate) {
              $date = $startDate->toDateString();
              $day = strtolower($startDate->format('l'));
              $dates[] = [
                'date' => $date,
                'day' => $day,
              ];
              $this->craeteFoodOrderItem($meals,  $food_order, $day, $cart, $date);
              $startDate->addDay();
            }
            $this->craeteFoodOrderItem($meals,  $food_order, 'common', $cart, null);
          }
          FoodCart::where('customer_id',$request->user()->id)->delete();
          DB::commit();
          return response()->json([
            'status' => true,
            'message' => 'Order Placed Successfully',
          ]);
        }elseif($type == 'laundry'){
          $carts = LaundryCart::where('customer_id', $request->user()->id)->with('items')->get();
          if(count($carts) < 1) {
            return response()->json([
              'status' => false,
              'message' => $message,
            ]);
          }
          $order_data['subtotal'] = $carts->sum('total');
          $order_data['tax'] = $carts->sum('total') * 5 / 100;
          $order_data['grand_total'] = $order_data['subtotal'] + $order_data['tax'];
          $order_data['service_date'] = $carts->first()->service_date;
          $order_data['start'] = $carts->first()->start;
          $order_data['end'] = $carts->first()->end;
          $order_data['area_id'] = $carts->first()->area_id;
          $order = Order::create($order_data);
          $this->createLaundryOrder($carts, $order->id, $request->user()->id);
          $ids = LaundryCart::where('customer_id',$request->user()->id)->pluck('id');
          LaundryCartItem::whereIn('laundry_cart_id', $ids)->delete();
          LaundryCart::where('customer_id',$request->user()->id)->delete();
          DB::commit();
          return response()->json([
            'status' => true,
            'message' => 'Order Placed Successfully',
          ]);
        }elseif($type == 'cab') {
          $cart = CabCart::where('customer_id', $request->user()->id)->latest()->first();
          if(!$cart) {
            return response()->json([
              'status' => false,
              'message' => $message,
            ]);
          }
          $subtotal = $cart->tour_type == 'local' ? ($cart->hours * $cart->fare->price) : $cart->fare->price;
          $order_data['subtotal'] = $subtotal;
          $order_data['tax'] = $subtotal * 5 / 100;
          $order_data['grand_total'] = $subtotal + $subtotal * 5 / 100;
          $order_data['service_date'] = $cart->service_date;
          $order_data['start'] = $cart->start;
          $order_data['end'] = $cart->end;
          $order_data['area_id'] = $cart->area_id;
          $order = Order::create($order_data);

          $cab_data['order_id'] = $order->id;
          $cab_data['customer_id'] = $request->user()->id;
          $cab_data['tour_type'] = $cart->tour_type;
          $cab_data['hours'] = $cart->hours;
          $cab_data['price'] = $cart->fare->price;
          $cab_data['origin'] = $cart->tour_type == 'local'
                                  ? $cart->tour_location
                                  : $cart->fare->outstation->origin->name;
          $cab_data['destination'] = $cart->tour_type == 'local' ? '' : $cart->fare->outstation->destination->name;
          $cab_data['pickup_location'] = $cart->pickup_location;
          $cab_data['instruction'] = $cart->instruction;
          $cab_data['cab_type'] = $cart->fare->cab->type;
          $cab_data['fare_id'] = $cart->fare_id;
          $cab_data['seats'] = $cart->fare->cab->seats;
          $cab_data['luggage'] = $cart->fare->cab->luggage;
          CabOrder::create($cab_data);
          CabCart::where('customer_id', $request->user()->id)->delete();
          DB::commit();
          return response()->json([
            'status' => true,
            'message' => 'CAB Booked Successfully',
          ]);
        }
      }catch (\Throwable $th) {
        DB::rollback();
        return response()->json([
          'status' => false,
          'error' => $th->getMessage()
        ]);
      }
    }

    private function createLaundryOrder($carts, $order_id, $user_id){
      $laundry_order_data['order_id'] = $order_id;
      $laundry_order_data['customer_id'] = $user_id;
      foreach ($carts as $cart) {
        $laundry_order_data['category_name'] = $cart->category_name;
        $laundry_order_data['total'] = $cart->total;
        $laundry_order_data['status'] = 'Active';
        $laundry_order = LaundryOrder::create($laundry_order_data);
        $item_data['laundry_order_id'] = $laundry_order->id;
        foreach ($cart->items as $item) {
          $item_data['service_name'] = $item->service_name;
          $item_data['price_per_piece'] = $item->price_per_piece;
          $item_data['quantity'] = $item->quantity;
          $item_data['total_price'] = $item->total_price;
          LaundryOrderItem::create($item_data);
        }
      }
    }

    private function craeteFoodOrderItem($meals, $food_order, $day, $cart, $date = null){
      foreach($meals as $meal) {
        $food_item['food_order_id'] = $food_order->id;
        $food_item['date'] = $date;
        $food_item['day'] = $day;
        $food_item['meal'] = $meal;
        $food_item['meal_items'] = $cart->package->items->where('day',$day)->where('meal',$meal)->first()->meal_items;
        if(($day == 'common' && $food_item['meal_items']) || $day != 'common') {
          FoodOrderItem::create($food_item);
        }
      }
    }

    private function getFoodSubtotal($cart) {
      if($cart->meal == 'Combo') {
        $subtotal = $cart->package->combo_price * $cart->quantity;
      }elseif($cart->meal == 'Single') {
        $subtotal = $cart->package->single_price * $cart->quantity;
      }else {
        $subtotal = $cart->package->all_price * $cart->quantity;
      }
      return $subtotal;
    }

    private function getFoodMeals($cart) {
      if($cart->meal == 'All') {
        $meals = ['breakfast', 'lunch', 'dinner'];
      }elseif($cart->meal == 'Combo') {
        $meals = explode('-', $cart->meal_type);
      }else {
        $meals = [$cart->meal_type];
      }
      return $meals;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Order $order)
    {
      $subOrderId = $request->subOrderId ?? null;
      return response()->json([
        'status' => true,
        'order_details' => $this->formatOrderDetail($order, $subOrderId)
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
