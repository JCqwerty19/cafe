<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function createOrder() {
        $variables = [
            'products' => Product::all(),
        ];

        return view('client.order', $variables);
    }

    public function makeOrder(OrderRequest $orderRequest) {

        $data = $orderRequest->validated();
        
        dd($data);

        $xx = $data->customer_name;

        dd($xx);
    }
}


// массив товаров // имя, количество, сумма
// далее создаем в БД новый объект заказ
// Отправляем на кухню

// total-price = цена
// customer-name = имя заказчика
// customer-phone = номер заказчика
// доставка или самомывоз bool
// address адрес
// items[] массив(
//      product_id = id продука
//      amount = arr
// )