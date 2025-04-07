<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CabTypeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
        return [
          'type' => [
            'required',
            'string',
            'max:255',
            Rule::unique('cabs', 'type')->whereNull('deleted_at'),
          ],
          'seats' => 'required|string|max:255',
          'icon' => 'required|image|mimes:jpeg,png,jpg|max:2048',
          'luggage' => 'nullable|string|max:255',
        ];
    }
}
