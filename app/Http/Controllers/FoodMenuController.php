<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\FoodMenu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\DataTables\FoodMenuDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FoodMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FoodMenuDataTable $dataTable)
    {
      return $dataTable->render('food_menu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $areas = Area::get();
      return view('food_menu.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->only('package','all_price','combo_price','breakfast_start','breakfast_end',
                               'lunch_start','lunch_end','dinner_start','dinner_end','area_id');
        $menu = FoodMenu::create($data);
        $menu_items = $request->menu;
        $item['food_menu_id'] = $menu->id;
        foreach ($menu_items as $day => $meals) {
          $item['day'] = $day;
          foreach ($meals as $meal => $items) {
            $item['meal'] = $meal;
            $item['meal_items'] = $items;
            MenuItem::create($item);
          }
        }
        DB::commit();
        Alert::toast('Menu Added Successfully','success');
        return redirect(route('food-menu.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodMenu $foodMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodMenu $foodMenu)
    {
      $areas = Area::get();
      return view('food_menu.edit', compact('foodMenu','areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodMenu $foodMenu)
    {
      try{
        DB::beginTransaction();
        $data = $request->only('package','all_price','combo_price','breakfast_start','breakfast_end',
                               'lunch_start','lunch_end','dinner_start','dinner_end','area_id');
        $foodMenu->update($data);
        $menu_items = $request->menu;
        $item['food_menu_id'] = $foodMenu->id;
        foreach ($menu_items as $day => $meals) {
          foreach ($meals as $meal => $items) {
            $item['day'] = $day;
            $item['meal'] = $meal;
            MenuItem::updateOrCreate($item, ['meal_items' => $items]);
          }
        }
        DB::commit();
        Alert::toast('Menu Updated Successfully','success');
        return redirect(route('food-menu.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodMenu $foodMenu)
    {
      try{
        MenuItem::where('food_menu_id', $foodMenu->id)->delete();
        $foodMenu->delete();
        Alert::toast('Menu Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }
}
