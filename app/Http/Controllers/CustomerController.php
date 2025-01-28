<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\DataTables\CustomersDataTable;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CustomersDataTable $dataTable)
    {
      return $dataTable->render('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $customer = Customer::create($data);
        DB::commit();
        Alert::toast('Customer Added Successfully','success');
        return redirect(route('customer.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
      return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
      try{
        DB::beginTransaction();
        $data = $request->except('_token');
        $customer->update($data);
        DB::commit();
        Alert::toast('Customer Updated Successfully','success');
        return redirect(route('customer.index'));
      }catch (\Throwable $th) {
        DB::rollback();
        Alert::error($th->getMessage());
        return redirect()->back();
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
      try{
        // $vendor = Vendor::find($id);
        $customer->delete();
        Alert::toast('Customer Deleted Successfully','success');
        return redirect()->back();
      }catch (\Throwable $th) {
        Alert::error($th->getMessage());
        DB::rollback();
        return redirect()->back();
      }
    }
}
