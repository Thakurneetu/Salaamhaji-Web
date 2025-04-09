<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    { 
      if($request->ajax()) {
        if($request->val == 'Yearly'){ 
          $currentYear = date('Y');
          $data['customer_count'] = Customer::whereYear('created_at', $currentYear)->count();
          $data['vendor_count']   = Vendor::whereYear('created_at', $currentYear)->count();
          $data['order_count']    = Order::whereYear('created_at', $currentYear)->count();
          $data['pending_order_count'] = Order::whereYear('created_at', $currentYear)->where('status','Order accepted')->count();
        }elseif($request->val == 'Monthly'){
          $currentMonth = date('m');
          $data['customer_count'] = Customer::whereMonth('created_at', $currentMonth)->count();
          $data['vendor_count']   = Vendor::whereMonth('created_at', $currentMonth)->count();
          $data['order_count']    = Order::whereMonth('created_at', $currentMonth)->count();
          $data['pending_order_count'] = Order::whereMonth('created_at', $currentMonth)->where('status','Order accepted')->count();
        }elseif($request->val == 'Weekly'){
          $weekStart = Carbon::now()->startOfWeek();
          $weekEnd = Carbon::now()->endOfWeek();
          $data['customer_count'] = Customer::where('created_at','>=', $weekStart)->where('created_at','<=', $weekEnd)->count();
          $data['vendor_count']   = Vendor::where('created_at','>=', $weekStart)->where('created_at','<=', $weekEnd)->count();
          $data['order_count']    = Order::where('created_at','>=', $weekStart)->where('created_at','<=', $weekEnd)->count();
          $data['pending_order_count'] = Order::where('created_at','>=', $weekStart)->where('created_at','<=', $weekEnd)->where('status','Order accepted')->count();
        }else{
          $currentDay = date('d');
          $data['customer_count'] = Customer::whereDay('created_at', $currentDay)->count();
          $data['vendor_count']   = Vendor::whereDay('created_at', $currentDay)->count();
          $data['order_count']    = Order::whereDay('created_at', $currentDay)->count();
          $data['pending_order_count'] = Order::whereDay('created_at', $currentDay)->where('status','Order accepted')->count();
        }
        return  $data;
      }
      $currentMonth = date('m');
      $customer_count = Customer::whereMonth('created_at', $currentMonth)->count();
      $vendor_count   = Vendor::whereMonth('created_at', $currentMonth)->count();
      $order_count    = Order::whereMonth('created_at', $currentMonth)->count();
      $pending_order_count = Order::select('*')->whereMonth('created_at', $currentMonth)->where('status','Order accepted')->count();
      $orders = Order::where('created_at', '>=', Carbon::now()->subDays(14))->latest()->get();
      return view('dashboard', compact('customer_count', 'vendor_count', 'order_count', 'pending_order_count', 'orders'));
    }

    public function profile(){
      $user = auth()->user();
      return view('profile', compact('user'));
    }
    public function profileUpdate(Request $request){
      $user = auth()->user();
      $data = $request->except('_token','password');
      $user->update($data);
      Alert::toast('Profile Updated Successfully','success');
      return redirect()->back();
    }
    public function changeForm(){
      $user = auth()->user();
      return view('change_password');
    }
    public function changePassword(Request $request){
      $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|confirmed',
      ]);
      $user = auth()->user();

      if (!Hash::check($request->old_password, $user->password)) {
        return back()->withErrors(['old_password' => 'The old password is incorrect.']);
      }
      $data['password'] = Hash::make($request->password);
      $user->update($data);
      Alert::toast('Password Changed Successfully','success');
      return redirect()->back();
    }
}
