<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'total_price' => '',
            'customer_name' => '',
            'customer_phone' => '',
            'obtaining' => '',
            'address' => '',
            'items' => '',
            // 'items.*.product_id' => '',
            // 'items.*.quantity' => '',
        ];
    }
}
