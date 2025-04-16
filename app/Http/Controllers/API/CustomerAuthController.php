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
use Illuminate\Support\Facades\Http;

class CustomerAuthController extends Controller
{
  use HelperTrait;

    public function send_otp(CustomerOTPRequest $request)
    {
      $number = '';
      if($request->has('type') && $request->type == 'login_otp'){
        $customer = Customer::where('phone', $request->phone)->first();
        if(!$customer){
          return response()->json([
            'status' => false,
            'message' => 'Phone number doesn\'t exist.',
          ], 401);
        }else{
          if($customer->status != 1){
            return response()->json([
              'status' => false,
              'message' => 'Your account has been deactivated. Please contact admin.',
            ], 401);
          }
          $number .= $customer->country_code;
        }
      }
      $number .= $request->phone;
      $otp = $this->randomToken(4);
      $find = CustomerOtp::where(['phone'=>$request->phone])->first();
      if($find){
        CustomerOtp::where(['phone'=>$request->phone])->update(['otp'=>$otp]);
      }else{
        CustomerOtp::create(['phone'=>$request->phone,'otp'=>$otp]);
      }
      $response = Http::get(env('WATSAPP_LOGIN_OTP_URL').'?number='.$number.'&otp='.$otp);
      $result = $response->json();
      if($result['accepted']) {
        return response()->json([
          'status' => true,
          'message' => 'OTP sent successfully',
          'test_otp' => $otp,
        ]);
      }else {
        return response()->json([
          'status' => false,
          'message' => 'Something went wrong, please try again later.',
        ]);
      }
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
        $data = $request->only('name', 'email', 'phone', 'gender', 'country_code');
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
