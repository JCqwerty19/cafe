<?php

namespace App\Repositories\Implementators\Eloquent\Staff;

use App\Repositories\Interfaces\Staff\DistributionRepositoryInterface;

use App\Models\Client\Order;

use App\DTO\Staff\DistributeDTO;

class DistributionRepositoryImplementator implements DistributionRepositoryInterface
{
    // Distribute function
    public function distribute(DistributeDTO $orderDTO) {
        
        $order = static::findOrder($orderDTO);
        
        // Checking and distribution
        if ($orderDTO->getObtaining() === 'pickup') {

            static::orderPickup($order);

        } else if ($orderDTO->getObtaining() === 'hall') {

            // Create order for hall
            static::orderHall($order);

        } else {

            static::orderDelivery($order);
        }
    }

    // ===============================================

    public static function findOrder(DistributeDTO $orderDTO): Order {

        return Order::find($orderDTO->getOrderId());

    }

    public static function orderPickup(Order $order): void {
        $order->status = 'Order waiting for you';
        $order->save();
    }

    public static function orderHall(Order $order): void {
        $order->status = 'Ready';
        $order->save();
    }

    public static function orderDelivery(Order $order): void {
        $order->status = 'Waiting for courier';
        $order->save();
    }
}