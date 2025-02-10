<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\DataTables\BannerDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\HelperTrait;

class BannerController extends Controller
{
  use HelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BannerDataTable $dataTable)
    {
      return $dataTable->render('banner.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->only('name');
        $data['image'] = $this->save_file($request->image, '/uploads/banners');
        $banner = Banner::create($data);
        DB::commit();
        Alert::toast('Promotional Banner Added Successfully','success');
        return redirect(route('banner.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
      return view('banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
      if($request->ajax()){
        $status = $request->status == '1' ? 1 : 0;
        $banner->update(['status'=>$status]);
        return response()->json([
          'success' => true, 'message' => 'Status Updated Successfully!'
        ]);
      }
      try{
        DB::beginTransaction();
        $data = $request->only('name');
        if($request->hasFile('image')){
          $this->delete_file($banner->image);
          $data['image'] = $this->save_file($request->image, '/uploads/banners');
        }
        $banner->update($data);
        DB::commit();
        Alert::toast('Promotional Banner Updated Successfully','success');
        return redirect(route('banner.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
      try{
        $this->delete_file($banner->image);
        $banner->delete();
        Alert::toast('Promotional Banner Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
