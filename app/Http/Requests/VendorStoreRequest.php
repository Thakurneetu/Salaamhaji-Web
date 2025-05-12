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
      $required_max = 'required|max:255';
        return [
          'name' => 'required|string|max:255',
          'email' => 'required|email|max:255',
          'phone' => 'required',
          'address1' => $required_max,
          'address2' => 'nullable|max:255',
          'city' => $required_max,
          'state' => $required_max,
          'zip' => $required_max,
          'country_id' => 'required',
          'services' => 'required',
        ];
    }
}
