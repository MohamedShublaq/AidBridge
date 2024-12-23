<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CivilianRegisterRequest extends FormRequest
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
            'name' => ['required','string','min:3','max:50'],
            'email' => ['required','email','unique:users,email'],
            'id_number' => ['required','string','unique:users,id_number'],
            'gender' => ['required','in:0,1'],
            'age' => ['required','integer','between:1,100'],
            'marital_status' => ['required','integer','between:1,4'],
            'childrens' => ['required_if:marital_status,2,3,4','integer','between:0,15'],
            'password' => ['required','min:8','confirmed'],
            'password_confirmation' => ['required'],
            'country_id' => ['required','exists:countries,id'],
            'city' => ['required','string','min:2','max:50'],
            'street' => ['required','string','min:2','max:50'],
            'phone' => ['required','string'],
            'id_photo' => ['required','image','mimes:jpg,jpeg,png','max:2048'],
        ];
    }
}