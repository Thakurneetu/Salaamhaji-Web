<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LaundryServiceStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
      return [
        'name' => [
          'required',
          'string',
          'max:255',
        ],
        'area_id' => 'required',
        'category_id' => 'required',
        'price' => 'required|max:255',
        'icon' => 'required|image|mimes:jpeg,png,jpg|max:2048',
      ];
    }

    public function messages()
    {
      return [
        'area_id.required' => 'Please Select Area.',
        'category_id.required' => 'Please Select Category.'
      ];
    }
}
