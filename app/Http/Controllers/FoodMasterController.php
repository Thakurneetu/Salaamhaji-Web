<?php

namespace App\Http\Controllers;

use App\Models\FoodMaster;
use Illuminate\Http\Request;
use App\Models\FoodCategory;
use App\DataTables\FoodMasterDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FoodMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FoodMasterDataTable $dataTable)
    {
      return $dataTable->render('food_master.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $categories = FoodCategory::where('status',1)->get();
      return view('food_master.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $customer = FoodMaster::create($data);
        DB::commit();
        Alert::toast('Service Added Successfully','success');
        return redirect(route('food_master.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodMaster $foodMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodMaster $foodMaster)
    {
      $categories = FoodCategory::where('status',1)->get();
      return view('food_master.edit', compact('foodMaster', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodMaster $foodMaster)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $foodMaster->update($data);
        DB::commit();
        Alert::toast('Service Updated Successfully','success');
        return redirect(route('food_master.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodMaster $foodMaster)
    {
      try{
        $foodMaster->delete();
        Alert::toast('Service Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
