<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LaundryCategoryUpdateRequest extends FormRequest
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
          Rule::unique('loundry_categories', 'name')->whereNull('deleted_at')->ignore($this->laundry_category->id),
        ],
      ];
    }
}
