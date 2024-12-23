<?php

namespace App\Http\Requests\Donor;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:2', 'max:50'],
            'email' => ['required', 'email', 'unique:donors,email,' . auth('donor')->user()->id],
            'country_id' => ['required', 'exists:countries,id'],
            'phone' => ['required' , 'string'],
        ];
    }
}