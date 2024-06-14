<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseController;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Http\Requests\OrderRequest;

use App\DTO\Client\OrderMakeDTO;
use App\DTO\Client\OrderItemsDTO;

class OrderController extends BaseController
{
    // Show order create view
    public function create() {

        // Collect variables for order create view
        $variables = [
            'products' => Product::all(),
        ];

        // Show order create view
        return view('client.order', $variables);
    }

    // ===============================================

    // Make order
    public function make(OrderRequest $orderRequest) {

        // Validate incoming data
        $orderData = $orderRequest->validated();

        // Create order DTO to show params
        $orderDTO = new OrderMakeDTO(
            customer_name: $orderData['customer_name'],
            customer_phone: $orderData['customer_phone'],
            obtaining: $orderData['obtaining'],
            address: $orderData['address'],
            total_price: $orderData['total_price'],
        );

        // Make and gain order
        $order = $this->getOrderService()->make($orderDTO);

        // Create order items DTO to show params
        $orderItemsDTO = new OrderItemsDTO(
            order_id: $order->id,
            items: $orderData['items'],
        );

        // Put order items
        $this->getOrderService()->putOrderItems($orderItemsDTO);
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