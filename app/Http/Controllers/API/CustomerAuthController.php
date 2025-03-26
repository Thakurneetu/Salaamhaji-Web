<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\CustomerOtp;
use App\Http\Requests\API\CustomerOTPRequest;
use App\Http\Requests\API\CustomerVerifyOtpRequest;
use App\Http\Requests\API\CustomerRegisterRequest;
use App\Http\Requests\API\ProfileRequest;
use App\Traits\HelperTrait;

class CustomerAuthController extends Controller
{
  use HelperTrait;

    public function send_otp(CustomerOTPRequest $request)
    {
      if($request->has('type') && $request->type == 'login_otp'){
        $customer = Customer::where('phone', $request->phone)->first();
        if(!$customer){
          return response()->json([
            'status' => false,
            'message' => 'Phone number doesn\'t exist.',
          ], 401);
        }
      }
      $otp = $this->randomToken(4);
      $find = CustomerOtp::where(['phone'=>$request->phone])->first();
      if($find){
        CustomerOtp::where(['phone'=>$request->phone])->update(['otp'=>$otp]);
      }else{
        CustomerOtp::create(['phone'=>$request->phone,'otp'=>$otp]);
      }
      return response()->json([
        'status' => true,
        'message' => 'OTP sent successfully',
        'test_otp' => $otp,
      ]);
    }

    public function verify_otp(CustomerVerifyOtpRequest $request)
    {
      $checkOtp = CustomerOtp::where(['phone'=>$request->phone, 'otp'=>$request->otp])->first();
      if(!$checkOtp){
        return response()->json([
          'status' => false,
          'message' => 'Invalid OTP',
        ], 401);
      }
      CustomerOtp::where(['phone'=>$request->phone, 'otp'=>$request->otp])->delete();
      if($request->has('type') && $request->type == 'login'){
        $customer = Customer::where('phone', $request->phone)->first();
        $customer->update(['country_code'=>$request->country_code]);
        $token = $customer->createToken('customer-token')->plainTextToken;
        return response()->json([
          'status' => true,
          "message" => "OTP Verified Successfully.",
          'access_token' => $token,
          'bearer' => 'Bearer '.$token,
        ]);
      }

      return response()->json([
        'status' => true,
        'message' => 'OTP Verified Successfully.',
      ]);
    }

    public function register(CustomerRegisterRequest $request)
    {
      try {
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);

        $token = $customer->createToken('customer-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Your account has been created successfully.',
            'access_token' => $token,
            'bearer' => 'Bearer '.$token,
            'customer' => $customer,
        ], 200);
      } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage(),
            'errors' => $th->getMessage(),
        ], 500);
      }
    }

    public function profile(ProfileRequest $request){
      try {
        $data = $request->only('name', 'email', 'phone', 'gender');
        $request->user()->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Your account has been updated successfully.',
            'customer' => $request->user(),
        ], 200);
      } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage(),
            'errors' => $th->getMessage(),
        ], 500);
      }
    }

    public function location(Request $request){
      try {
        $data = $request->only('latitude', 'longitude');
        $request->user()->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Your location has been updated successfully.',
        ], 200);
      } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage(),
            'errors' => $th->getMessage(),
        ], 500);
      }
    }
}
