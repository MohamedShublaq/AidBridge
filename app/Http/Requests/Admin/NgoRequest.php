<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NgoRequest extends FormRequest
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
            'email' => ['required','email','unique:ngos,email'],
            'description' => ['required','string','min:10'],
            'password' => ['required','min:8','confirmed'],
            'password_confirmation' => ['required'],
            'address' => ['required','string','min:3','max:50'],
            'phone' => ['required','string'],
            'logo' => ['required','image','mimes:jpg,jpeg,png','max:2048']
        ];
    }
}