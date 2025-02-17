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

}