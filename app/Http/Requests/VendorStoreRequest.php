<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendorStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
        return [
          'name' => 'required|string|max:255',
          'email' => 'required|email|max:255',
          'phone' => 'required',
          'address1' => 'required|max:255',
          'address2' => 'nullable|max:255',
          'city' => 'required|max:255',
          'state' => 'required|max:255',
          'zip' => 'required|max:255',
          'country_id' => 'required',
          'services' => 'required',
        ];
    }
}
