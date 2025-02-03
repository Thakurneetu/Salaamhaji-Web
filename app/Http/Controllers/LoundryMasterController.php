<?php

namespace App\Http\Controllers;

use App\Models\LoundryMaster;
use App\Models\LoundryCategory;
use Illuminate\Http\Request;
use App\DataTables\LoundryMasterDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class LoundryMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LoundryMasterDataTable $dataTable)
    {
      return $dataTable->render('loundry_master.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $categories = LoundryCategory::where('status',1)->get();
      return view('loundry_master.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $customer = LoundryMaster::create($data);
        DB::commit();
        Alert::toast('Service Added Successfully','success');
        return redirect(route('loundry_master.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(LoundryMaster $loundryMaster)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoundryMaster $loundryMaster)
    {
      $categories = LoundryCategory::where('status',1)->get();
      return view('loundry_master.edit', compact('loundryMaster', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoundryMaster $loundryMaster)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $loundryMaster->update($data);
        DB::commit();
        Alert::toast('Service Updated Successfully','success');
        return redirect(route('loundry_master.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoundryMaster $loundryMaster)
    {
      try{
        $loundryMaster->delete();
        Alert::toast('Service Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
