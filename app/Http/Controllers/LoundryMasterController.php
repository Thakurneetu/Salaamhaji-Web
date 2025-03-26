<?php

namespace App\Http\Controllers;

use App\Models\LoundryMaster;
use App\Models\LoundryCategory;
use Illuminate\Http\Request;
use App\DataTables\LoundryMasterDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\HelperTrait;

class LoundryMasterController extends Controller
{
  use HelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(LoundryMasterDataTable $dataTable)
    {
      return $dataTable->render('laundry_master.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $categories = LoundryCategory::where('status',1)->get();
      return view('laundry_master.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        if($request->hasFile('icon')){
          $data['icon'] = $this->saveFile($request->icon, '/uploads/laundry');
        }
        LoundryMaster::create($data);
        DB::commit();
        Alert::toast('Service Added Successfully','success');
        return redirect(route('laundry_master.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(LoundryMaster $laundryMaster)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoundryMaster $laundryMaster)
    {
      $categories = LoundryCategory::where('status',1)->get();
      return view('laundry_master.edit', compact('laundryMaster', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoundryMaster $laundryMaster)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        if($request->hasFile('icon')){
          if($laundryMaster->icon != '') {
            $this->deleteFile($laundryMaster->icon);
          }
          $data['icon'] = $this->saveFile($request->icon, '/uploads/laundry');
        }
        $laundryMaster->update($data);
        DB::commit();
        Alert::toast('Service Updated Successfully','success');
        return redirect(route('laundry_master.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoundryMaster $laundryMaster)
    {
      try{
        $laundryMaster->delete();
        Alert::toast('Service Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
