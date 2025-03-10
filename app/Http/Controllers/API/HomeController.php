<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Customer;
use App\Models\Notice;
use Carbon\Carbon;
use App\Traits\HelperTrait;

class HomeController extends Controller
{
  use HelperTrait;

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
      $bookings = $this->formatOrders($orders);
      return response()->json([
        'status' => true,
        'profile' => $request->user(),
        'upcoming_bookings' => $bookings
      ]);
    }

    public function notice($module)
    {
      $notice = Notice::where('module', $module)->first();
      $message = $notice ? ($notice->message ?? null) : null;
      return response()->json([
        'status' => true,
        'notice' => $message,
      ]);
    }
}
