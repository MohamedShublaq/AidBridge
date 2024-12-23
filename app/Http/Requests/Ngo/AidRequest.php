<?php

namespace App\Http\Requests\Ngo;

use Illuminate\Foundation\Http\FormRequest;

class AidRequest extends FormRequest
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
            'description' => ['required','string','min:10'],
            'type' => ['required','in:1,2,3'],
            'quantity' => ['required','integer'],
            'locations' => ['required','array','min:1'],
            'ngo_id' => ['required','exists:ngos,id'],
        ];
    }
}