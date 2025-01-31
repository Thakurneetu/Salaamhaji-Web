<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

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
}
