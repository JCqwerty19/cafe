<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

use App\Models\Client\Order;
use App\Models\Staff\DeliveryOrders;

use App\DTO\Staff\DeliveryDTO\DeliveryDTO;

class DeliveryController extends BaseController
{
    public function list() {
        $variables = [
            'orders' => Order::where('status', 'Waiting for courier')->get(),
        ];

        return view('staff.delivery_list', $variables);
    }

    public function deliver(Order $order) {

        $deliveryDTO = new DeliveryDTO(
            courier_id: 1,
            order_id: $order->id,
        );

        $this->getDeliverySerivce()->deliver($deliveryDTO);
    }

    public function orders() {

        $variables = [
            'orders' => DeliveryOrders::where('courier_id', 1)->with('order')->get()->pluck('order'),
        ];
        
        return view('staff.delivery_orders', $variables);
    }
}
