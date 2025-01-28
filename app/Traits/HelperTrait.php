<?php 

namespace App\Traits;

use File;
use Carbon\Carbon;
use App\Models\Holiday;
use App\Models\Setting;
use App\Models\User;
use App\Models\LeaveType;
use Spatie\Permission\Models\Role;

trait HelperTrait {

  function __construct() {
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

}