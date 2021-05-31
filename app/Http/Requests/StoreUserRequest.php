<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'email'=>[
                'required',
                'email:rfc,dns',
                Rule::unique('users')->ignore($this->email, 'email')
            ],
            'password'=>[

            ],
            'gender'=>[
                Rule::in(['male', 'female']),
            ],
            'national_id' => [
                'max:14',
                'min:14'
            ],
            'avatar' => [
                'image',
                'nullable',
                'max:1999'
            ],
            'name' => [],
            'phone' => [
                'numeric'
            ],
            'role' => [
                Rule::in(['admin','manager','receptionist','client']),
            ],
            'country' => [],

        ];
    }
}
