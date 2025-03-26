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
use App\Http\Requests\VendorRegisterRequest;

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
      $countries = Country::get();
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
        if($request->hasFile('laundry_catalogue')){
          $data['laundry_catalogue'] = $this->saveFile($request->laundry_catalogue, config('constants.CATALOGUE'));
        }
        if($request->hasFile('food_catalogue')){
          $data['food_catalogue'] = $this->saveFile($request->food_catalogue, config('constants.CATALOGUE'));
        }
        if($request->hasFile('cab_catalogue')){
          $data['cab_catalogue'] = $this->saveFile($request->cab_catalogue, config('constants.CATALOGUE'));
        }
        Vendor::create($data);
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
      $countries = Country::get();
      $services = explode(',',$vendor->services);
      return view('vendors.edit', compact('countries','vendor','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      $vendor = Vendor::find($id);
      if($request->ajax()){
        $status = $request->status == '1' ? 1 : 0;
        $vendor->update(['status'=>$status]);
        return response()->json([
          'success' => true, 'message' => 'Status Updated Successfully!'
        ]);
      }
      try{
        DB::beginTransaction();
        $data = $request->except('_token', 'cab_catalogue', 'food_catalogue', 'laundry_catalogue');
        $services = explode(',',$request->services);
        if($request->hasFile('laundry_catalogue')){
          $this->deleteFile($vendor->laundry_catalogue);
          $data['laundry_catalogue'] = $this->saveFile($request->laundry_catalogue, config('constants.CATALOGUE'));
        }else{
          if(!in_array('Laundry',$services)){
            $this->deleteFile($vendor->laundry_catalogue);
            $data['laundry_catalogue'] = '';
          }
        }
        if($request->hasFile('food_catalogue')){
          $this->deleteFile($vendor->food_catalogue);
          $data['food_catalogue'] = $this->saveFile($request->food_catalogue, config('constants.CATALOGUE'));
        }else{
          if(!in_array('Food',$services)){
            $this->deleteFile($vendor->food_catalogue);
            $data['food_catalogue'] = '';
          }
        }
        if($request->hasFile('cab_catalogue')){
          $this->deleteFile($vendor->cab_catalogue);
          $data['cab_catalogue'] = $this->saveFile($request->cab_catalogue, config('constants.CATALOGUE'));
        }else{
          if(!in_array('CAB',$services)){
            $this->deleteFile($vendor->cab_catalogue);
            $data['cab_catalogue'] = '';
          }
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
        if($vendor->laundry_catalogue) {$this->deleteFile($vendor->laundry_catalogue);}
        if($vendor->food_catalogue) {$this->deleteFile($vendor->food_catalogue);}
        if($vendor->cab_catalogue) {$this->deleteFile($vendor->cab_catalogue);}
        $vendor->delete();
        Alert::toast('Vendor Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }

    public function vendorForm(){
      $countries = Country::get();
      return view('vendor_registration', compact('countries'));
    }
    
    public function vendorFormSubmit(VendorRegisterRequest $request){
      try{
        DB::beginTransaction();
        $data = $request->except('_token', 'catalogue');
        if($request->hasFile('catalogue')){
          if($request->services == 'Laundry'){
            $data['laundry_catalogue'] = $this->saveFile($request->catalogue, config('constants.CATALOGUE'));
          }elseif($request->services == 'Food'){
            $data['food_catalogue'] = $this->saveFile($request->catalogue, config('constants.CATALOGUE'));
          }else{
            $data['cab_catalogue'] = $this->saveFile($request->catalogue, config('constants.CATALOGUE'));
          }
        }
        Vendor::create($data);
        DB::commit();
        return view('registration_success');
      }catch (\Throwable $th) {
        DB::rollback();
        return redirect()->back();
      }
    }
}
