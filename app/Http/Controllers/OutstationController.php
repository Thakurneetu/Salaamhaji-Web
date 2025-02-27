<?php

namespace App\Http\Controllers;

use App\Models\Cab;
use App\Models\Location;
use App\Models\Outstation;
use App\Models\OutstationFare;
use Illuminate\Http\Request;
use App\DataTables\OutstationFareDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OutstationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OutstationFareDataTable $dataTable)
    {
      return $dataTable->render('outstation_fare.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      if($request->ajax()){
        $ids = Outstation::where('origin_id', $request->origin_id)->pluck('destination_id')->toArray();
        $ids[] = $request->origin_id;
        $destinations = Location::select('id', 'name')->whereNotIn('id',$ids)->get();
        return response()->json([
          'success' => true,
          'destinations' => $destinations
        ]);
      }
      $cabs = Cab::get();
      $locations = Location::get();
      $origins = $locations;
      $destinations = $locations;
      return view('outstation_fare.create', compact('origins','destinations','cabs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        $data = $request->only('origin_id', 'destination_id');
        $prices = $request->prices;
        if (empty(array_filter($prices, fn($value) => !is_null($value)))) {
          Alert::toast('Please provide atleast one price.','warning');
          return redirect()->back()->withInput();
        }
        DB::beginTransaction();
        $outstation = Outstation::create($data);
        $fare['outstation_id'] = $outstation->id;
        foreach ($prices as $key => $price) {
          if($price){
            $fare['cab_id'] = $key;
            $fare['price'] = $price;
            OutstationFare::create($fare);
          }
        }
        DB::commit();
        Alert::toast('Fares Added Successfully','success');
        return redirect(route('outstation-fare.index'));
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
    public function edit($id)
    {
      $outstation = Outstation::find($id);
      $cabs = Cab::get();
      $origins = Location::whereId($outstation->origin_id)->get();
      $destinations = Location::whereId($outstation->destination_id)->get();
      return view('outstation_fare.edit', compact('origins','destinations','cabs','outstation'));
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
        $outstation = Outstation::find($id);
        $data['outstation_id'] = $outstation->id;
        foreach ($prices as $key => $price) {
          $data['cab_id'] = $key;
          if($price){
            OutstationFare::updateOrCreate($data,[
              'price' => $price,
            ]);
          }else{
            OutstationFare::where($data)->delete();
          }
        }
        DB::commit();
        Alert::toast('Fares Updated Successfully','success');
        return redirect(route('outstation-fare.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      try{
        OutstationFare::where('outstation_id', $id)->delete();
        Outstation::find($id)->delete();
        Alert::toast('Outstation Fares Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
