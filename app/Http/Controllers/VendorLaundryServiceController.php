<?php

namespace App\Http\Controllers;

use App\Models\VendorLaundryService;
use App\Models\LoundryCategory;
use Illuminate\Http\Request;
use App\DataTables\VendorLaundryServiceDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class VendorLaundryServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorLaundryServiceDataTable $dataTable, Request $request)
    {
      return $dataTable->with('id', $request->id)->render('vendor_laundry_service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      $vendor_id = $request->id;
      $categories = LoundryCategory::where('status',1)->get();
      return view('vendor_laundry_service.create', compact('categories', 'vendor_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        VendorLaundryService::create($data);
        DB::commit();
        Alert::toast('Service Added Successfully','success');
        return redirect(route('vendor-laundry-service.index', ['id'=>$request->vendor_id]));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(VendorLaundryService $vendorLaundryService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VendorLaundryService $vendorLaundryService)
    {
      $categories = LoundryCategory::where('status',1)->get();
      return view('vendor_laundry_service.edit', compact('vendorLaundryService', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VendorLaundryService $vendorLaundryService)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $vendorLaundryService->update($data);
        DB::commit();
        Alert::toast('Service Updated Successfully','success');
        return redirect(route('vendor-laundry-service.index', ['id'=>$vendorLaundryService->vendor_id]));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendorLaundryService $vendorLaundryService)
    {
      try{
        $vendorLaundryService->delete();
        Alert::toast('Service Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
