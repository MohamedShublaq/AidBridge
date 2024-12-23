<?php

namespace App\Http\Requests\Civilian;

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
            'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id],
            'id_number' => ['required','string','unique:users,id_number,' . auth()->user()->id],
            'country_id' => ['required', 'exists:countries,id'],
            'city' => ['required' , 'string' , 'min:2' , 'max:50'],
            'street' => ['required' , 'string' , 'min:2' , 'max:50'],
            'phone' => ['required' , 'string'],
            'id_photo' => ['required','image','mimes:jpg,jpeg,png','max:2048'],
        ];
    }
}