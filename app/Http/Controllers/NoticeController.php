<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cab_notice = '';
        $cab = Notice::where('module','cab')->first();
        if($cab) {
          $cab_notice = $cab->message;
        }
        $food_notice = '';
        $food = Notice::where('module','food')->first();
        if($food) {
          $food_notice = $food->message;
        }
        return view('notice.index', compact('cab_notice','food_notice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        // dd($request->all());
        DB::beginTransaction();
        Notice::updateOrCreate(['module'=>'cab'],['message'=>$request->cab_notice]);
        Notice::updateOrCreate(['module'=>'food'],['message'=>$request->food_notice]);
        DB::commit();
        Alert::toast('Notices Saved Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notice $notice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        //
    }
}
