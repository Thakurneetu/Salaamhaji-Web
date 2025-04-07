<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CustomerStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
      return [
        'name' => 'required|string|max:255',
        'email' => [
          'required',
          'string',
          'email',
          'max:255',
          Rule::unique('customers')->whereNull('deleted_at'),
        ],
        'phone' => [
          'required',
          'string',
          'max:20',
          Rule::unique('customers')->whereNull('deleted_at'),
        ],
        'gender' => 'required|string|max:100',
      ];
    }
}
