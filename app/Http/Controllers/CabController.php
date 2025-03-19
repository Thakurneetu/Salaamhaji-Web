<?php

namespace App\Http\Controllers;

use App\Models\Cab;
use Illuminate\Http\Request;
use App\DataTables\CabDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\HelperTrait;

class CabController extends Controller
{
  use HelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(CabDataTable $dataTable)
    {
      return $dataTable->render('cab.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('cab.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->only('type','seats','luggage');
        if($request->hasFile('icon')){
          $data['icon'] = $this->save_file($request->icon, '/uploads/cab');
        }
        $cab = Cab::create($data);
        DB::commit();
        Alert::toast('CAB Type Added Successfully','success');
        return redirect(route('cab.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cab $cab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cab $cab)
    {
      return view('cab.edit', compact('cab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cab $cab)
    {
      try{
        DB::beginTransaction();
        $data = $request->only('type','seats','luggage');
        if($request->hasFile('icon')){
          if($cab->icon != '')
          $this->delete_file($cab->icon);
          $data['icon'] = $this->save_file($request->icon, '/uploads/cab');
        }
        $cab->update($data);
        DB::commit();
        Alert::toast('CAB Type Updated Successfully','success');
        return redirect(route('cab.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cab $cab)
    {
      try{
        $this->delete_file($cab->icon);
        $cab->delete();
        Alert::toast('CAB Type Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
