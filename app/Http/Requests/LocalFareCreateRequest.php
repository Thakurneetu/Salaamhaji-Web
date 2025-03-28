<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LocalFareCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
        return [
          'cab_id' => [
              'required',
              Rule::unique('local_fares')->where(function ($query)  {
                return $query->where('area_id', request()->input('area_id'));
              }),
          ],
          'area_id' => 'required',
          'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
          'cab_id.required' => 'Please Select CAB Type.',
          'cab_id.unique' => 'CAB fare for this area already exist.',
          'area_id.required' => 'Please select area.',
          'price.required' => 'Please enter fare.',
        ];
    }
}
