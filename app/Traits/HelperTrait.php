<?php

namespace App\Traits;

use File;
use Carbon\Carbon;
use App\Models\Holiday;
use App\Models\Setting;
use App\Models\User;
use App\Models\Order;
use App\Models\LeaveType;
use Spatie\Permission\Models\Role;
use Intervention\Image\Laravel\Facades\Image;

trait HelperTrait {

  private function generateUniqueOrderId(): string
  {
      do {
          $orderId = (string) mt_rand(10000000, 99999999);
      } while (Order::where('uuid', 'SH'.$orderId)->exists());

      return 'SH'.$orderId;
  }

  private function randomToken($n) {
    $chareacters = '123456789';
    $str = '';
    for($i = 0; $i < $n; $i++){
        $index = rand(0, strlen($chareacters)-1);
        $str .= $chareacters[$index];
    }
    return $str;
  }

  private function saveFile($file, $store_path){
    $extension = File::extension($file->getClientOriginalName());
    $filename = rand(10,99).date('YmdHis').rand(10,99).'.'.$extension;
    $file-> move(public_path($store_path), $filename);
    return $store_path.'/'.$filename;
  }

  private function deleteFile($file_path){
    File::delete(public_path().$file_path);
  }

  private function createThumbnail($path, $width, $height)
  {
    try{
      $img = ImageCreateFromString(file_get_contents($path));
      if ($img === false) {
          return false;
      }

      // Get original dimensions
      $originalWidth = imagesx($img);
      $originalHeight = imagesy($img);

      // Calculate the scaling ratio
      $ratio = max($width / $originalWidth, $height / $originalHeight);

      // Calculate new dimensions
      $newWidth = $originalWidth * $ratio;
      $newHeight = $originalHeight * $ratio;

      // Create a new image with the new dimensions
      $newImg = imagecreatetruecolor($newWidth, $newHeight);

      // Resize the image
      imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

      // Crop the image to the desired size
      $offsetX = ($newWidth - $width) / 2;
      $offsetY = ($newHeight - $height) / 2;
      $croppedImg = imagecreatetruecolor($width, $height);
      imagecopy($croppedImg, $newImg, 0, 0, $offsetX, $offsetY, $width, $height);

      // Save the thumbnail
      $thumbnailPath = dirname($path) . '/thumbnails/' . basename($path);
      imagejpeg($croppedImg, $thumbnailPath);

      // Free up memory
      imagedestroy($img);
      imagedestroy($newImg);
      imagedestroy($croppedImg);

      return $thumbnailPath;
    }catch(\Exception $e){
      return false;
    }
  }

  private function formatOrders($orders){
    $bookings = array();
    $key=0;
    foreach ($orders as $order) {
      if($order->type == 'food'){
          $bookings[$key]['id'] = $order->id;
          $bookings[$key]['sub_order_id'] = null;
          $bookings[$key]['type'] = $order->type;
          $bookings[$key]['time_slot'] = '';
          $bookings[$key]['service_date'] = date(config('constants.DATE'),strtotime($order->food_order->from)) .' - '. date(config('constants.DATE'),strtotime($order->food_order->to));
          $bookings[$key]['start'] = '';
          $bookings[$key]['end'] = '';
          $bookings[$key]['status'] = $this->getOrderStatus($order->status);
          $bookings[$key]['quantity'] = (string)$order->food_order->quantity;
          $bookings[$key]['price'] = $order->grand_total;
          $bookings[$key]['service_name'] = $order->food_order->package.' - '.$order->food_order->meal;
          if($order->food_order->meal == 'All') {
            $bookings[$key]['service_name'] .= '(Breakfast, Lunch, Dinner)';
          }
          else {
            $bookings[$key]['service_name'] .= '('.implode(', ', array_map('ucfirst', explode('-', $order->food_order->meal_type))).')';
          }
          $bookings[$key]['from'] = '';
          $bookings[$key]['to'] = '';
          $bookings[$key]['pickup_location'] = '';
          $key++;
      }elseif($order->type == 'laundry'){
          $bookings[$key]['id'] = $order->id;
          $bookings[$key]['sub_order_id'] = null;
          $bookings[$key]['type'] = $order->type;
          $bookings[$key]['time_slot'] = $order->formatted_service_time;
          $bookings[$key]['service_date'] = $order->service_date;
          $bookings[$key]['start'] = $order->start;
          $bookings[$key]['end'] = $order->end;
          $bookings[$key]['status'] = $this->getOrderStatus($order->status);
          $bookings[$key]['quantity'] = '';
          $bookings[$key]['price'] = $order->grand_total;
          $services = $order->laundry_orders->pluck('category_name')->sort()->values()->toArray();
          $bookings[$key]['service_name'] = implode(', ',$services);
          $bookings[$key]['from'] = '';
          $bookings[$key]['to'] = '';
          $bookings[$key]['pickup_location'] = '';
          $key++;
      }elseif($order->type == 'cab'){
          $bookings[$key]['id'] = $order->id;
          $bookings[$key]['sub_order_id'] = null;
          $bookings[$key]['type'] = $order->type;
          $bookings[$key]['time_slot'] = $order->formatted_service_time;
          $bookings[$key]['service_date'] = $order->service_date;
          $bookings[$key]['start'] = $order->start;
          $bookings[$key]['end'] = $order->end;
          $bookings[$key]['status'] = $this->getOrderStatus($order->status);
          $bookings[$key]['quantity'] = '';
          $bookings[$key]['price'] = $order->grand_total;
          $bookings[$key]['service_name'] = $order->cab_order->tour_type;
          $bookings[$key]['from'] = $order->cab_order->origin;
          $bookings[$key]['to'] = $order->cab_order->destination;
          $bookings[$key]['pickup_location'] = $order->cab_order->pickup_location;
          $key++;
      }
    }
    return $bookings;
  }

  private function getOrderStatus($status){
    return $status == 'Order assigned to vendor' ? 'Order in progress' : $status;
  }

  private function formatOrderDetail($order, $subOrderId = null){
    $booking = array();
    $date_format = 'd M Y';
    if($order->type == 'food'){
        $booking['id'] = $order->id;
        $booking['sub_order_id'] = null;
        $booking['type'] = $order->type;
        $booking['order_date'] = date($date_format,strtotime($order->created_at));
        $booking['service_date'] = date(config('constants.DATE'),strtotime($order->food_order->from)) .' - '. date(config('constants.DATE'),strtotime($order->food_order->to));
        $booking['service_name'] = $order->food_order->meal.', '.$order->food_order->package;
        $booking['quantity'] = (string)$order->food_order->quantity;
        $booking['from'] = null;
        $booking['to'] = null;
        $booking['price'] = $order->subtotal;
        $booking['status'] = $this->getOrderStatus($order->status);
        $booking['address_line_1'] = $order->address_line_1;
        $booking['address_line_2'] =  $order->address_line_2;
        $booking['landmark'] =  $order->landmark;
        $booking['pickup_location'] = null;
        $booking['icon'] = null;
        $booking['seats'] = null;
        $booking['luggage'] = null;
        $booking['hours'] = null;
        $booking['laoundry_items'] = null;
        $booking['subtotal'] = $order->subtotal;
        $booking['tax'] = $order->tax;
        $booking['grand_total'] = $order->grand_total;
    }elseif($order->type == 'laundry'){
      foreach ($order->laundry_orders as $item) {
        if($item->id == $subOrderId) {
          $booking['id'] = $order->id;
          $booking['sub_order_id'] = $subOrderId;
          $booking['type'] = $order->type;
          $booking['order_date'] = date($date_format,strtotime($order->created_at));
          $booking['service_date'] = $order->formatted_service_time;
          $booking['service_name'] = $item->category_name;
          $booking['quantity'] = null;
          $booking['from'] = null;
          $booking['to'] = null;
          $booking['price'] = $item->total;
          $booking['status'] = $this->getOrderStatus($order->status);
          $booking['address_line_1'] = $order->address_line_1;
          $booking['address_line_2'] =  $order->address_line_2;
          $booking['landmark'] =  $order->landmark;
          $booking['pickup_location'] = null;
          $booking['icon'] = null;
          $booking['seats'] = null;
          $booking['luggage'] = null;
          $booking['hours'] = null;
          foreach ($item->items as $key => $value) {
            $booking['laoundry_items'][$key]['name'] = $value->service_name;
            $booking['laoundry_items'][$key]['price'] = $value->price_per_piece;
            $booking['laoundry_items'][$key]['quantity'] = $value->quantity;
            $booking['laoundry_items'][$key]['total'] = $value->total_price;
          }
          $booking['subtotal'] = $item->total;
          $booking['tax'] = $this->getLaundryTax($order->tax, $item->total, $order->subtotal);
          if($order->tax > 0) {
            $booking['tax'] = number_format(($order->tax * $item->total / $order->subtotal), 2, '.', '');
          }else {
            $booking['tax'] = '0.00';
          }
          $booking['grand_total'] = number_format(($booking['subtotal'] + $booking['tax']), 2, '.', '');
        }
      }
    }elseif($order->type == 'cab'){
        $booking['id'] = $order->id;
        $booking['sub_order_id'] = null;
        $booking['type'] = $order->type;
        $booking['order_date'] = date($date_format,strtotime($order->created_at));
        $booking['service_date'] = $order->formatted_service_time;
        $booking['service_name'] = $order->cab_order->tour_type;
        $booking['quantity'] = null;
        $booking['from'] = $order->cab_order->origin;
        $booking['to'] = $order->cab_order->destination;
        $booking['price'] = $order->subtotal;
        $booking['status'] = $this->getOrderStatus($order->status);
        $booking['address_line_1'] = null;
        $booking['address_line_2'] =  null;
        $booking['landmark'] =  null;
        $booking['pickup_location'] = $order->cab_order->pickup_location;
        $booking['icon'] = $order->cab_order->fare->cab->icon_url ?? null;
        $booking['seats'] = $order->cab_order->seats;
        $booking['luggage'] = $order->cab_order->luggage;
        $booking['hours'] = $order->cab_order->hours;
        $booking['laoundry_items'] = null;
        $booking['subtotal'] = $order->subtotal;
        $booking['tax'] = $order->tax;
        $booking['grand_total'] = $order->grand_total;
    }
    return $booking;
  }

  private function getLaundryTax($order_tax, $total, $subtotal){
    if($order_tax > 0) {
      $tax = number_format(($order_tax * $total / $subtotal), 2, '.', '');
    }else {
      $tax = '0.00';
    }
    return $tax;
  }

  private function foodOrders($carts){
    $subtotal = 0; $items = [];
    foreach ($carts as $key => $cart) {
      $items[$key]['id'] = $cart->id;
      $items[$key]['meal'] = $cart->meal;
      $items[$key]['package'] = $cart->package->package;
      $items[$key]['from'] = $cart->from;
      $items[$key]['to'] = $cart->to;
      $items[$key]['formatted_time'] = $cart->formatted_date;
      if($cart->meal == 'Combo') {
        $items[$key]['price'] = $cart->package->combo_price;
        $price = $cart->package->combo_price * $cart->quantity;
      }elseif($cart->meal == 'Single') {
        $items[$key]['price'] = $cart->package->single_price;
        $price = $cart->package->single_price * $cart->quantity;
      }else {
        $items[$key]['price'] = $cart->package->all_price;
        $price = $cart->package->all_price * $cart->quantity;
      }
      $items[$key]['quantity'] = $cart->quantity;
      $items[$key]['total'] = number_format($price, 2, '.', '');
      $subtotal += $price;
    }
    return ['subtotal'=>$subtotal, 'items'=>$items];
  }

}
