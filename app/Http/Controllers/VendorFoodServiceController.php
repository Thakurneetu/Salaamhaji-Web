<?php

namespace App\Http\Controllers;

use App\Models\VendorFoodService;
use App\Models\VendorFoodServiceItem;
use Illuminate\Http\Request;
use App\DataTables\VendorFoodServiceDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class VendorFoodServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorFoodServiceDataTable $dataTable, Request $request)
    {
      return $dataTable->with('id', $request->id)->render('vendor_food_service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      $vendor_id = $request->id;
      return view('vendor_food_service.create', compact('vendor_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->only('vendor_id','package','all_price','combo_price','breakfast_start','breakfast_end',
                               'lunch_start','lunch_end','dinner_start','dinner_end',);
        $menu = VendorFoodService::create($data);
        $menu_items = $request->menu;
        $item['vendor_food_service_id'] = $menu->id;
        foreach ($menu_items as $day => $meals) {
          $item['day'] = $day;
          foreach ($meals as $meal => $items) {
            $item['meal'] = $meal;
            $item['meal_items'] = $items;
            VendorFoodServiceItem::create($item);
          }
        }
        DB::commit();
        Alert::toast('Service Menu Added Successfully','success');
        return redirect(route('vendor-food-service.index', ['id'=>$request->vendor_id]));
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
      return view('vendor_food_service.edit', compact('vendorFoodService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VendorFoodService $vendorFoodService)
    {
      try{
        DB::beginTransaction();
        $data = $request->only('package','all_price','combo_price','breakfast_start','breakfast_end',
                               'lunch_start','lunch_end','dinner_start','dinner_end',);
        $vendorFoodService->update($data);
        $menu_items = $request->menu;
        $item['vendor_food_service_id'] = $vendorFoodService->id;
        foreach ($menu_items as $day => $meals) {
          foreach ($meals as $meal => $items) {
            $item['day'] = $day;
            $item['meal'] = $meal;
            VendorFoodServiceItem::updateOrCreate($item, ['meal_items' => $items]);
          }
        }
        DB::commit();
        Alert::toast('Service Menu Updated Successfully','success');
        return redirect(route('vendor-food-service.index', ['id'=>$vendorFoodService->vendor_id]));
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
        VendorFoodServiceItem::where('vendor_food_service_id', $foodMenu->id)->delete();
        $vendorFoodService->delete();
        Alert::toast('Service Menu Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
