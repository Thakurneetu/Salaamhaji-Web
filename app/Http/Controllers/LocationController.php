<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Location;
use Illuminate\Http\Request;
use App\DataTables\LocationDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\LocationCreateRequest;
use App\Http\Requests\LocationUpdateRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LocationDataTable $dataTable)
    {
      return $dataTable->render('location.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $areas = Area::get();
      return view('location.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationCreateRequest $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->only('name','area_id');
        Location::create($data);
        DB::commit();
        Alert::toast('Location Added Successfully','success');
        return redirect(route('location.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
      $areas = Area::get();
      return view('location.edit', compact('location','areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationUpdateRequest $request, Location $location)
    {
      try{
        DB::beginTransaction();
        $data = $request->only('name','area_id');
        $location->update($data);
        DB::commit();
        Alert::toast('Location Updated Successfully','success');
        return redirect(route('location.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
      try{
        $location->delete();
        Alert::toast('Location Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
