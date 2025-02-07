<?php

namespace App\Http\Controllers;

use App\Models\VendorFoodService;
use Illuminate\Http\Request;
use App\Models\FoodCategory;
use App\DataTables\VendorFoodServiceDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class VendorFoodServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFoodServiceDataTable $dataTable)
    {
      return $dataTable->render('vendor_food_service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      $vendor_id = $request->id;
      $categories = FoodCategory::where('status',1)->get();
      return view('vendor_food_service.create', compact('categories','vendor_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $customer = VendorFoodService::create($data);
        DB::commit();
        Alert::toast('Service Added Successfully','success');
        return redirect(route('vendor_food_service.index', ['id'=>$request->vendor_id]));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(VendorFoodService $vendorFoodService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VendorFoodService $vendorFoodService)
    {
      $categories = FoodCategory::where('status',1)->get();
      return view('vendor_food_service.edit', compact('vendorFoodService', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VendorFoodService $vendorFoodService)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $vendorFoodService->update($data);
        DB::commit();
        Alert::toast('Service Updated Successfully','success');
        return redirect(route('vendor_food_service.index', ['id'=>$vendorFoodService->vendor_id]));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendorFoodService $vendorFoodService)
    {
      try{
        $vendorFoodService->delete();
        Alert::toast('Service Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
