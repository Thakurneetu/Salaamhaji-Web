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

  function __construct() {
  }

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

  private function save_file($file, $store_path){
    $extension = File::extension($file->getClientOriginalName());
    $filename = rand(10,99).date('YmdHis').rand(10,99).'.'.$extension;
    $file-> move(public_path($store_path), $filename);
    return $store_path.'/'.$filename;
  }

  private function delete_file($file_path){
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
          $bookings[$key]['type'] = $order->type;
          $bookings[$key]['time_slot'] = '';
          $bookings[$key]['service_date'] = date('d/m/Y',strtotime($order->food_order->from)) .' - '. date('d/m/Y',strtotime($order->food_order->to));
          $bookings[$key]['start'] = '';
          $bookings[$key]['end'] = '';
          $bookings[$key]['status'] = $order->status;
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
          $bookings[$key]['pickup_location'] = '';
          $key++;
        }
      }else if($order->type == 'cab'){
          $bookings[$key]['id'] = $order->id;
          $bookings[$key]['type'] = $order->type;
          $bookings[$key]['time_slot'] = $order->formatted_service_time;
          $bookings[$key]['service_date'] = $order->service_date;
          $bookings[$key]['start'] = $order->start;
          $bookings[$key]['end'] = $order->end;
          $bookings[$key]['status'] = $order->status;
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
      }else if($cart->meal == 'Single') {
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