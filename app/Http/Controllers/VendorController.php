<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Country;
use Illuminate\Http\Request;
use App\DataTables\VendorsDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\HelperTrait;
use File;

class VendorController extends Controller
{
  use HelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorsDataTable $dataTable)
    {
      return $dataTable->render('vendors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $countries = Country:: get();
      return view('vendors.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token', 'catalogue');
        if($request->hasFile('catalogue')){
          $data['catalogue'] = $this->save_file($request->catalogue, '/uploads/catalogue');
        }
        $vendor = Vendor::create($data);
        DB::commit();
        Alert::toast('Vendor Added Successfully','success');
        return redirect(route('vendor-users.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $vendor = Vendor::find($id);
      $countries = Country:: get();
      return view('vendors.edit', compact('countries','vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      try{
        $vendor = Vendor::find($id);
        DB::beginTransaction();
        $data = $request->except('_token', 'catalogue');
        if($request->hasFile('catalogue')){
          $this->delete_file($vendor->catalogue);
          $data['catalogue'] = $this->save_file($request->catalogue, '/uploads/catalogue');
        }
        $vendor->update($data);
        DB::commit();
        Alert::toast('Vendor Updated Successfully','success');
        return redirect(route('vendor-users.index'));
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
        $vendor = Vendor::find($id);
        $this->delete_file($vendor->catalogue);
        $vendor->delete();
        Alert::toast('Vendor Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
