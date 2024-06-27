<?php

namespace App\Repositories\Implementators\Eloquent\Staff;

use App\Repositories\Interfaces\Staff\DeliveryRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Client\Order;
use App\Models\Staff\Deliveries;

class DeliveryRepositoryImplementator implements DeliveryRepository
{
    public function deliver(int $order_id): void
    {
        // get current courier id
        $courier_id = Auth::guard('courier')->user()->id;

        // find current order
        $order = static::findOrder($order_id);

        // change order status
        static::changeStatus($order);

        // create new delivery in current courier list
        static::deliverOrder($courier_id, $order_id);
    }
    
    // find order
    public function findOrder(int $order_id): Order
    {
        return Order::find($order_id);
    }

    // change order status
    public function changeStatus(Order $order): void
    {
        $order->status = 'Courier will deliver it soon';
        $order->save();
    }

    // create delivery in courier's list
    public static function deliverOrder(int $courier_id, int $order_id)
    {
        // collect data
        $data = [
            'courier_id' => $courier_id,
            'order_id' => $order_id,
        ];

        // create delivery
        Deliveries::create($data);
    }
}