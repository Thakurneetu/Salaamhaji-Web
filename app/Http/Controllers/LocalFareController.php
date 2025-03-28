<?php

namespace App\Http\Controllers;

use App\Models\Cab;
use App\Models\Area;
use App\Models\LocalFare;
use Illuminate\Http\Request;
use App\DataTables\LocalFareDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\LocalFareCreateRequest;
use App\Http\Requests\LocalFareUpdateRequest;

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
      $areas = Area::get();
      return view('local_fare.create', compact('cabs','areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocalFareCreateRequest $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->only('cab_id','price','area_id');
        LocalFare::create($data);
        DB::commit();
        Alert::toast('Fare Added Successfully','success');
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
      $local_fare = LocalFare::find($id);
      $areas = Area::get();
      return view('local_fare.edit', compact('cabs','local_fare','areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocalFareUpdateRequest $request, $id)
    {
      try{
        $data = $request->only('cab_id','area_id','price');
        DB::beginTransaction();
        LocalFare::find($id)->update($data);
        DB::commit();
        Alert::toast('Fare Updated Successfully','success');
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
        LocalFare::where('cab_id', $id)->delete();
        Alert::toast('Local Fare Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
