<?php

namespace App\Http\Controllers;

use App\Models\LoundryCategory;
use Illuminate\Http\Request;
use App\DataTables\LoundryCategoryDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class LoundryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LoundryCategoryDataTable $dataTable)
    {
      return $dataTable->render('laundry_category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('laundry_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        LoundryCategory::create($data);
        DB::commit();
        Alert::toast('Category Added Successfully','success');
        return redirect(route('laundry_category.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(LoundryCategory $laundryCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoundryCategory $laundryCategory)
    {
      return view('laundry_category.edit', compact('laundryCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoundryCategory $laundryCategory)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $laundryCategory->update($data);
        DB::commit();
        Alert::toast('Category Updated Successfully','success');
        return redirect(route('laundry_category.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoundryCategory $laundryCategory)
    {
      try{
        $laundryCategory->delete();
        Alert::toast('Category Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
