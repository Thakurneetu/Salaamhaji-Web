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
    public function index()
    { 
     // print_r($_REQUEST); die;
      if(isset($_REQUEST['val']) && $_REQUEST['val']=='Yearly'){ 
        $currentYear = date('Y');
        $previousYear = $currentYear - 1;

        $data['customer_count'] = Customer::whereYear('created_at', $currentYear)->count();
        $data['vendor_count']   = Vendor::whereYear('created_at', $currentYear)->count();
        $data['order_count']    = Order::whereYear('created_at', $currentYear)->count();
        $data['pending_order_count'] = Order::select('*')->whereYear('created_at', $currentYear)->where('status','Active')->count();
        $orders_data = Order::select('orders.*','customers.name as customer_name')
        ->join('customers', 'customers.id','orders.customer_id')
        ->whereYear('orders.created_at', $currentYear)
        ->get();
        $data['orders'] = '';
        if(count($orders_data)>0){
          foreach($orders_data as $item){
            $data['orders'] .='<tr><td><a href="order/'.$item->id.'?type='.$item->type.'">'.$item->uuid.'</a></td>
              <td>'.$item->type.'</td>
              <td>'.$item->customer_name.'</td>
              <td>'.$item->grand_total.'</td>
              <td>';
                if($item->status=="Active")
                $data['orders'] .='<span class="badge badge-danger">'.$item->status.'</span>';
                else if($item->status=='Out for delivery')
                $data['orders'] .='<span class="badge badge-warning">'.$item->status.'</span>';
                else if($item->status=='Confirmed')
                $data['orders'] .='<span class="badge badge-success">'.$item->status.'</span>';
                $data['orders'] .='</td>';
                $data['orders'] .='</tr>';
          }
        }else{
          $data['orders'] = '<tr><td colspan="4">No Orders Found</td></tr>';
        }
        
        return  $data;
      }else if(isset($_REQUEST['val']) && $_REQUEST['val']=='Monthly'){
        $currentMonth = date('m');
        $previousMonth = $currentMonth - 1;

        $data['customer_count'] = Customer::whereMonth('created_at', $currentMonth)->count();
        $data['vendor_count']   = Vendor::whereMonth('created_at', $currentMonth)->count();
        $data['order_count']    = Order::whereMonth('created_at', $currentMonth)->count();
        $data['pending_order_count'] = Order::select('*')->whereMonth('created_at', $currentMonth)->where('status','Active')->count();
        $orders_data = Order::select('orders.*','customers.name as customer_name')
        ->join('customers', 'customers.id','orders.customer_id')
        ->whereMonth('orders.created_at', $currentMonth)
        ->get();

        $data['orders'] = '';
        if(count($orders_data)>0){
          foreach($orders_data as $item){
            $data['orders'] .='<tr><td><a href="order/'.$item->id.'?type='.$item->type.'">'.$item->uuid.'</a></td>
              <td>'.$item->type.'</td>
              <td>'.$item->customer_name.'</td>
              <td>'.$item->grand_total.'</td>
              <td>';
                if($item->status=="Active")
                $data['orders'] .='<span class="badge badge-danger">'.$item->status.'</span>';
                else if($item->status=='Out for delivery')
                $data['orders'] .='<span class="badge badge-warning">'.$item->status.'</span>';
                else if($item->status=='Confirmed')
                $data['orders'] .='<span class="badge badge-success">'.$item->status.'</span>';
                $data['orders'] .='</td>';
                $data['orders'] .='</tr>';
          }
        }else{
          $data['orders'] = '<tr><td colspan="4">No Orders Found</td></tr>';
        }
        
        return  $data;
        
      }else if(isset($_REQUEST['val']) && $_REQUEST['val']=='Weekly'){
        $currentMonth = date('m');
        $previousMonth = $currentMonth - 1;

        $data['customer_count'] = Customer::whereMonth('created_at', $currentMonth)->count();
        $data['vendor_count']   = Vendor::whereMonth('created_at', $currentMonth)->count();
        $data['order_count']    = Order::whereMonth('created_at', $currentMonth)->count();
        $data['pending_order_count'] = Order::select('*')->whereMonth('created_at', $currentMonth)->where('status','Active')->count();
        $orders_data = Order::select('orders.*','customers.name as customer_name')
        ->join('customers', 'customers.id','orders.customer_id')
        ->whereMonth('orders.created_at', $currentMonth)
        ->get();

        $data['orders'] = '';
        if(count($orders_data)>0){
          foreach($orders_data as $item){
            $data['orders'] .='<tr><td><a href="order/'.$item->id.'?type='.$item->type.'">'.$item->uuid.'</a></td>
              <td>'.$item->type.'</td>
              <td>'.$item->customer_name.'</td>
              <td>'.$item->grand_total.'</td>
              <td>';
                if($item->status=="Active")
                $data['orders'] .='<span class="badge badge-danger">'.$item->status.'</span>';
                else if($item->status=='Out for delivery')
                $data['orders'] .='<span class="badge badge-warning">'.$item->status.'</span>';
                else if($item->status=='Confirmed')
                $data['orders'] .='<span class="badge badge-success">'.$item->status.'</span>';
                $data['orders'] .='</td>';
                $data['orders'] .='</tr>';
          }
        }else{
          $data['orders'] = '<tr><td colspan="4">No Orders Found</td></tr>';
        }

        return  $data;
      }else if(isset($_REQUEST['val']) && $_REQUEST['val']=='Today'){
        $currentDay = date('d');
        $previousDay = $currentDay - 1;

        $data['customer_count'] = Customer::whereDay('created_at', $currentDay)->count();
        $data['vendor_count']   = Vendor::whereDay('created_at', $currentDay)->count();
        $data['order_count']    = Order::whereDay('created_at', $currentDay)->count();
        $data['pending_order_count'] = Order::select('*')->whereDay('created_at', $currentDay)->where('status','Active')->count();
        $orders_data = Order::select('orders.*','customers.name as customer_name')
        ->join('customers', 'customers.id','orders.customer_id')
        ->whereDay('orders.created_at', $currentDay)
        ->get();

        $data['orders'] = '';
        if(count($orders_data)>0){
          foreach($orders_data as $item){
            $data['orders'] .='<tr><td><a href="order/'.$item->id.'?type='.$item->type.'">'.$item->uuid.'</a></td>
              <td>'.$item->type.'</td>
              <td>'.$item->customer_name.'</td>
              <td>'.$item->grand_total.'</td>
              <td>';
                if($item->status=="Active")
                $data['orders'] .='<span class="badge badge-danger">'.$item->status.'</span>';
                else if($item->status=='Out for delivery')
                $data['orders'] .='<span class="badge badge-warning">'.$item->status.'</span>';
                else if($item->status=='Confirmed')
                $data['orders'] .='<span class="badge badge-success">'.$item->status.'</span>';
                $data['orders'] .='</td>';
                $data['orders'] .='</tr>';
          }
        }else{
          $data['orders'] = '<tr><td colspan="4">No Orders Found</td></tr>';
        }

        return  $data;
      }else{
        $data['customer_count'] = Customer::count()+1;
        $data['vendor_count']   = Vendor::count()+1;
        $data['order_count']    = Order::count()+1;
        $data['pending_order_count'] = Order::select('*')->where('status','Active')->count()+1;
        $data['orders'] = Order::select('orders.*','customers.name as customer_name')
        ->join('customers', 'customers.id','orders.customer_id')
        ->latest()
        ->take(10)
        ->get();
        return view('dashboard',$data);
      }
      
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
