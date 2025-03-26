<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use Illuminate\Http\Request;
use App\DataTables\FoodCategoryDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FoodCategoryDataTable $dataTable)
    {
      return $dataTable->render('food_category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('food_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        FoodCategory::create($data);
        DB::commit();
        Alert::toast('Category Added Successfully','success');
        return redirect(route('food_category.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodCategory $foodCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodCategory $foodCategory)
    {
      return view('food_category.edit', compact('foodCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodCategory $foodCategory)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $foodCategory->update($data);
        DB::commit();
        Alert::toast('Category Updated Successfully','success');
        return redirect(route('food_category.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodCategory $foodCategory)
    {
      try{
        $foodCategory->delete();
        Alert::toast('Category Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
