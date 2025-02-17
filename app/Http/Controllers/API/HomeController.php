<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Customer;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function banners()
    {
      $banners = Banner::select('name', 'image')->where('status', 1)->get();
      return response()->json([
        'status' => true,
        'banners' => $banners,
      ]);
    }

    public function home(Request $request)
    {
      $orders = $request->user()->upcomingOrders();
      $bookings = array();
      $key=0;
      foreach ($orders as $order) {
        if($order->type == 'food'){
          foreach ($order->food_items as $item) {
            $bookings[$key]['id'] = $order->id;
            $bookings[$key]['type'] = $order->type;
            $bookings[$key]['time_slot'] = $order->formatted_service_time;
            $bookings[$key]['service_date'] = $order->service_date;
            $bookings[$key]['start'] = $order->start;
            $bookings[$key]['end'] = $order->end;
            $bookings[$key]['status'] = $order->status;
            $bookings[$key]['quantity'] = (string)$item->quantity;
            $bookings[$key]['price'] = $item->total_price;
            $bookings[$key]['service_name'] = $item->service_name;
            $bookings[$key]['from'] = '';
            $bookings[$key]['to'] = '';
            $key++;
          }
        }else if($order->type == 'laundry'){
          foreach ($order->laundry_orders as $item) {
            $bookings[$key]['id'] = $order->id;
            $bookings[$key]['type'] = $order->type;
            $bookings[$key]['time_slot'] = $order->formatted_service_time;
            $bookings[$key]['service_date'] = $order->service_date;
            $bookings[$key]['start'] = $order->start;
            $bookings[$key]['end'] = $order->end;
            $bookings[$key]['status'] = $order->status;
            $bookings[$key]['quantity'] = '';
            $bookings[$key]['price'] = $item->total;
            $bookings[$key]['service_name'] = $item->category_name;
            $bookings[$key]['from'] = '';
            $bookings[$key]['to'] = '';
            $key++;
          }
        }
      }
      return response()->json([
        'status' => true,
        'profile' => $request->user(),
        'upcoming_bookings' => $bookings
      ]);
    }
}
