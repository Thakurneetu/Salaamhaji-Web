<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\LaundryOrder;
use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrdersDataTable $dataTable, Request $request)
    {
      return $dataTable->with('type', $request->type??'laundry')->render('order.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
      if($request->ajax()){
        $order->update(['status'=>$request->status]);
        return response()->json([
          'success'=>true,
          'message'=>'Status Updated Successfully.',
          $order
        ]);
      }
      $data = $request->except('_token','_method');
      $order->update($data);
      Alert::toast('Vendor Details Updated Successfully','success');
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
