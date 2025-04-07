<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
      return [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:customers,email,'.$this->customer->id,
        'phone' => 'required|string|max:20|unique:customers,phone,'.$this->customer->id,
        'gender' => 'required|string|max:500',
        'country_code' => 'required|string|max:10',
      ];
    }
}
