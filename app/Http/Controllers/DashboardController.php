<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

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
      return view('dashboard');
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
