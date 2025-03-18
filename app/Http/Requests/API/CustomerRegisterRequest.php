<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CustomerRegisterRequest extends FormRequest
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
            'max:255',
            Rule::unique('customers')->whereNull('deleted_at'),
          ],
          'gender' => 'required|string|max:100',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors(),
        ], 500));
    }
}
