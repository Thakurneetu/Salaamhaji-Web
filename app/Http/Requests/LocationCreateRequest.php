<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LocationCreateRequest extends FormRequest
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
              Rule::unique('locations')->whereNull('deleted_at')->where(function ($query)  {
                return $query->where('area_id', request()->input('area_id'));
              }),
          ],
          'area_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
          'name.required' => 'Please Select CAB Type.',
          'name.unique' => 'Location for this area already exist.',
          'area_id.required' => 'Please select area.',
        ];
    }
}
