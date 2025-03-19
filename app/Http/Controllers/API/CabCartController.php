<?php

namespace App\Http\Controllers\API;

use App\Models\CabCart;
use App\Models\LocalFare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CabCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $threshold = Carbon::now()->addHours(24);
      $cabCarts =  CabCart::where('customer_id', $request->user()->id)->where(function ($query) use ($threshold) {
            $query->where(DB::raw("CONCAT(service_date, ' ', start)"), '<=', $threshold);
        })
        ->delete();
        
      $tours = CabCart::where('customer_id', $request->user()->id)->get();
      $carts = []; $subtotal=0;
      foreach ($tours as $key => $tour) {
        $carts[$key]['id'] = $tour->id;
        $carts[$key]['tour_type'] = $tour->tour_type;
        $carts[$key]['service_date'] = $tour->service_date;
        $carts[$key]['start'] = $tour->start;
        $carts[$key]['end'] = $tour->end;
        $carts[$key]['hours'] = $tour->hours;
        $carts[$key]['price'] = $tour->fare->price;
        $carts[$key]['total_price'] = $tour->tour_type == 'local' 
                                      ? number_format($tour->hours * $tour->fare->price, 2, '.', '') 
                                      : number_format($tour->fare->price, 2, '.', '');
        $carts[$key]['origin'] = $tour->tour_type == 'local' 
                                 ? $tour->tour_location
                                 : $tour->fare->outstation->origin->name;
        $carts[$key]['destination'] = $tour->tour_type == 'local' ? '' : $tour->fare->outstation->destination->name;
        $carts[$key]['pickup_location'] = $tour->pickup_location;
        $carts[$key]['instruction'] = $tour->instruction;
        $carts[$key]['cab_type'] = $tour->fare->cab->type;
        $carts[$key]['seats'] = $tour->fare->cab->seats;
        $carts[$key]['luggage'] = $tour->fare->cab->luggage;
        $carts[$key]['icon_url'] = $tour->fare->cab->icon_url;
        $subtotal += $tour->tour_type == 'local' ? ($tour->hours * $tour->fare->price) : $tour->fare->price;
      }
      return response()->json([
        'status' => true,
        'subtotal' => number_format($subtotal, 2, '.', '') ,
        'tax' => number_format($subtotal * 5 / 100, 2, '.', '') ,
        'grand_total' => number_format($subtotal + $subtotal * 5 / 100, 2, '.', '') ,
        'carts' => $carts
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $threshold = Carbon::now()->addHours(24);
        $serviceDate = Carbon::parse($request->service_date.' '.$request->start);
        if ($serviceDate->lessThan($threshold)) {
          return response()->json([
            'status' => false,
            'message' => 'Please select valid date.',
          ]);
        }
        $data = $request->only('tour_type','service_date','start','end','fare_id',
                               'instruction','pickup_location','hours','tour_location');
        if($request->tour_type == 'outstation'){
          $data['hours'] = null;
          $data['pickup_location'] = null;
        }
        $data['customer_id'] = $request->user()->id;
        CabCart::updateOrCreate(['customer_id'=>$request->user()->id],$data);
        return response()->json([
          'status' => true,
          'message' => 'Tour added to cart successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CabCart $cabCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CabCart $cabCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CabCart $cabCart)
    {
      $cabCart->delete();
      return response()->json([
        'status' => true,
        'message' => 'Removed from cart successfully.',
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function clear(Request $request)
    {
      CabCart::where('customer_id',$request->user()->id)->delete();
      return response()->json([
        'status' => true,
        'message' => 'Cart Cleared successfully.',
      ]);
    }
}
