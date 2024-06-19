<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
            'customer_name' => 'required|string',
            'customer_phone' => 'required',
            'obtaining' => 'required|string',
            'address' => 'nullable|string',
            'total_price' => 'required|numeric',
            'additional_price' => 'required|numeric',
            'items.*.product_id' => 'required|numeric',
            'items.*.quantity' => 'required|numeric',
        ];
    }
}
