<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoundryMaster;
use App\Models\LoundryCategory;

class LaundryController extends Controller
{
    public function categories()
    {
      $categories = LoundryCategory::select('id', 'name')->where('status', 1)->get();
      return response()->json([
        'status' => true,
        'categories' => $categories,
      ]);
    }
    public function services($id)
    {
      $services = LoundryMaster::select('id', 'name','price')->where('category_id', $id)->where('status', 1)->get();
      return response()->json([
        'status' => true,
        'services' => $services,
      ]);
    }
}
