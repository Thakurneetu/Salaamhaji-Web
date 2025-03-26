<?php

namespace App\Http\Controllers;

use App\Models\VendorLocalFare;
use Illuminate\Http\Request;
use App\Models\Cab;
use App\DataTables\VendorLocalFareDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class VendorLocalFareController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(VendorLocalFareDataTable $dataTable, Request $request)
  {
    $vendor_id = $request->id;
    return $dataTable->with('id', $request->id)->render('vendor_fares.local_fare.index', compact('vendor_id'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request)
  {
    $vendor_id = $request->id;
    $cabs = Cab::doesntHave('vendor_local_fare')->get();
    return view('vendor_fares.local_fare.create', compact('cabs','vendor_id'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try{
      DB::beginTransaction();
      $data = $request->only('cab_id','price','vendor_id');
      // dd($data);
      VendorLocalFare::create($data);
      DB::commit();
      Alert::toast('Fare Added Successfully','success');
      return redirect(route('vendor-local-service.index').'?id='.$request->vendor_id);
    }catch (\Throwable $th) {
      DB::rollback();
      Alert::error($th->getMessage());
      return redirect()->back();
    }
  }

    /**
     * Display the specified resource.
     */
    public function show(VendorLocalFare $vendorLocalFare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
      $vendor_id = $request->id;
      $cabs = Cab::whereId($id)->get();
      $cab = Cab::find($id);
      return view('vendor_fares.local_fare.edit', compact('cabs','cab','vendor_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      try{
        $data = $request->only('cab_id','vendor_id');
        $price = $request->only('price');
        DB::beginTransaction();
        VendorLocalFare::updateOrCreate($data,$price);
        DB::commit();
        Alert::toast('Fare Updated Successfully','success');
        return redirect(route('vendor-local-service.index').'?id='.$request->vendor_id);
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
        VendorLocalFare::where(['cab_id'=>$id, 'vendor_id'=>$request->vendor_id])->delete();
        Alert::toast('Local Fare Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
