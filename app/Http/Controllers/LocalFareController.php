<?php

namespace App\Http\Controllers;

use App\Models\Cab;
use App\Models\Location;
use App\Models\LocalFare;
use Illuminate\Http\Request;
use App\DataTables\LocalFareDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class LocalFareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LocalFareDataTable $dataTable)
    {
      return $dataTable->render('local_fare.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $cabs = Cab::get();
      $locations = Location::doesntHave('local_fares')->get();
      return view('local_fare.create', compact('locations','cabs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        $data = $request->only('location_id');
        $prices = $request->prices;
        if (empty(array_filter($prices, fn($value) => !is_null($value)))) {
          Alert::toast('Please provide atleast one price.','warning');
          return redirect()->back()->withInput();
        }
        DB::beginTransaction();
        foreach ($prices as $key => $price) {
          if($price){
            $data['cab_id'] = $key;
            $data['price_per_hour'] = $price;
            LocalFare::create($data);
          }
        }
        DB::commit();
        Alert::toast('Prices Added Successfully','success');
        return redirect(route('local-fare.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(LocalFare $localFare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $cabs = Cab::get();
      $locations = Location::whereId($id)->get();
      $location = Location::find($id);
      return view('local_fare.edit', compact('locations','cabs','location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      try{
        $data = $request->only('location_id');
        $prices = $request->prices;
        if (empty(array_filter($prices, fn($value) => !is_null($value)))) {
          Alert::toast('Please provide atleast one price.','warning');
          return redirect()->back()->withInput();
        }
        DB::beginTransaction();
        foreach ($prices as $key => $price) {
          $data['cab_id'] = $key;
          if($price){
            LocalFare::updateOrCreate($data,[
              'price_per_hour' => $price,
            ]);
          }else{
            LocalFare::where($data)->delete();
          }
        }
        DB::commit();
        Alert::toast('Price Updated Successfully','success');
        return redirect(route('local-fare.index'));
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
        LocalFare::where('location_id', $id)->delete();
        Alert::toast('Price Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
