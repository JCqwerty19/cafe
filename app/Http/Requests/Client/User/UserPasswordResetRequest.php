<?php

namespace App\Http\Requests\Client\User;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordResetRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string',
            'password_confirmation' => 'required|string',
        ];
    }
}
