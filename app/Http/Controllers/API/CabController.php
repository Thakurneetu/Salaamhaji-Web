<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\LocalFare;
use App\Models\Outstation;

class CabController extends Controller
{
    public function locations(Request $request)
    {
      if($request->has('origin') && $request->origin != '') {
        $ids = Outstation::where(['origin_id'=>$request->origin])->pluck('destination_id');
        $locations = Location::select('id', 'name')->whereIn('id', $ids)->get();
      }else {
        $locations = Location::select('id', 'name')->get();
      }
      return response()->json([
        'status' => true,
        'locations' => $locations,
      ]);
    }

    public function local_fares()
    {
      $fares = LocalFare::get();
      $data = [];
      foreach ($fares as $key => $fare) {
        $data[$key]['id'] = $fare->id;
        $data[$key]['price'] = $fare->price;
        $data[$key]['type'] = $fare->cab->type;
        $data[$key]['seats'] = $fare->cab->seats;
        $data[$key]['luggage'] = $fare->cab->luggage;
        $data[$key]['icon_url'] = $fare->cab->icon_url;
      }
      return response()->json([
        'status' => true,
        'fares' => $data,
      ]);
    }

    public function outstation_fares($origin, $destination)
    {
      $trip = Outstation::where(['origin_id'=>$origin, 'destination_id'=>$destination])->first();
      $data = [];
      foreach ($trip->fares as $key => $fare) {
        $data[$key]['id'] = $fare->id;
        $data[$key]['price'] = $fare->price;
        $data[$key]['type'] = $fare->cab->type;
        $data[$key]['seats'] = $fare->cab->seats;
        $data[$key]['luggage'] = $fare->cab->luggage;
        $data[$key]['icon_url'] = $fare->cab->icon_url;
      }
      return response()->json([
        'status' => true,
        'fares' => $data,
      ]);
    }
}
