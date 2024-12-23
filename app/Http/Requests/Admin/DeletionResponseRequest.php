<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeletionResponseRequest extends FormRequest
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
            'notification_id' => ['required','exists:notifications,id'],
            'deletion_request_id' => ['required','exists:deletion_requests,id'],
            'response' => ['required','in:0,1'],
        ];
    }
}