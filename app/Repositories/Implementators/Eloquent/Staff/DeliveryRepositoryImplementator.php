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
        $order = $this->findOrder($order_id);

        // change order status
        $this->changeStatus($order);

        // create new delivery in current courier list
        $this->deliverOrder($courier_id, $order_id);
    }
    
    // find order
    private function findOrder(int $order_id): Order
    {
        return Order::find($order_id);
    }

    // change order status
    private function changeStatus(Order $order): void
    {
        $order->status = 'Courier will deliver it soon';
        $order->save();
    }

    // create delivery in courier's list
    private function deliverOrder(int $courier_id, int $order_id)
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