<?php

namespace App\Http\Controllers;

use App\Models\VendorOutstation;
use Illuminate\Http\Request;
use App\Models\Cab;
use App\Models\Location;
use App\Models\VendorOutstationFare;
use App\DataTables\VendorOutstationFareDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class VendorOutstationController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(VendorOutstationFareDataTable $dataTable, Request $request)
  {
    $vendor_id = $request->id;
    return $dataTable->with('id', $request->id)->render('vendor_fares.outstation_fare.index', compact('vendor_id'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request)
  {
    if($request->ajax()){
      $ids = VendorOutstation::where('vendor_id', $request->vendor_id)->where('origin_id', $request->origin_id)->pluck('destination_id')->toArray();
      $ids[] = $request->origin_id;
      $destinations = Location::select('id', 'name')->whereNotIn('id',$ids)->get();
      return response()->json([
        'success' => true,
        'destinations' => $destinations
      ]);
    }
    $vendor_id = $request->id;
    $cabs = Cab::get();
    $locations = Location::get();
    $origins = $locations;
    $destinations = $locations;
    return view('vendor_fares.outstation_fare.create', compact('origins','destinations','cabs','vendor_id'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try{
      $data = $request->only('origin_id', 'destination_id','vendor_id');
      $prices = $request->prices;
      if (empty(array_filter($prices, fn($value) => !is_null($value)))) {
        Alert::toast('Please provide atleast one price.','warning');
        return redirect()->back()->withInput();
      }
      DB::beginTransaction();
      $outstation = VendorOutstation::create($data);
      $fare['vendor_outstation_id'] = $outstation->id;
      foreach ($prices as $key => $price) {
        if($price){
          $fare['cab_id'] = $key;
          $fare['price'] = $price;
          VendorOutstationFare::create($fare);
        }
      }
      DB::commit();
      Alert::toast('Fares Added Successfully','success');
      return redirect(route('vendor-outstation-service.index').'?id='.$request->vendor_id);
    }catch (\Throwable $th) {
      DB::rollback();
      Alert::error($th->getMessage());
      return redirect()->back();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Outstation $outstation)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id, Request $request)
  {
    $outstation = VendorOutstation::find($id);
    $cabs = Cab::get();
    $vendor_id = $request->id;
    $origins = Location::whereId($outstation->origin_id)->get();
    $destinations = Location::whereId($outstation->destination_id)->get();
    return view('vendor_fares.outstation_fare.edit', compact('origins','destinations','cabs','outstation','vendor_id'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    try{
      $prices = $request->prices;
      if (empty(array_filter($prices, fn($value) => !is_null($value)))) {
        Alert::toast('Please provide atleast one fare.','warning');
        return redirect()->back()->withInput();
      }
      DB::beginTransaction();
      $outstation = VendorOutstation::find($id);
      $data['vendor_outstation_id'] = $outstation->id;
      foreach ($prices as $key => $price) {
        $data['cab_id'] = $key;
        if($price){
          VendorOutstationFare::updateOrCreate($data,[
            'price' => $price,
          ]);
        }else{
          VendorOutstationFare::where($data)->delete();
        }
      }
      DB::commit();
      Alert::toast('Fares Updated Successfully','success');
      return redirect(route('vendor-outstation-service.index').'?id='.$request->vendor_id);
    }catch (\Throwable $th) {
      DB::rollback();
      Alert::error($th->getMessage());
      return redirect()->back();
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id, Request $request)
  {
    try{
      VendorOutstationFare::where('vendor_outstation_id', $id)->delete();
      VendorOutstation::find($id)->delete();
      Alert::toast('Outstation Fares Deleted Successfully','success');
      return redirect()->back();
    }catch (\Throwable $th) {
      Alert::error($th->getMessage());
      DB::rollback();
      return redirect()->back();
    }
  }
}
