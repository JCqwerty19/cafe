<?php

namespace App\Http\Requests\Client\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueEmail;

class UserUpdateRequest extends FormRequest
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
            'username' => 'required|string',
            'email' => ['required', 'email', new UniqueEmail()],
            'phone' => '',
            'address' => '',
            'password' => '',
        ];
    }
}
