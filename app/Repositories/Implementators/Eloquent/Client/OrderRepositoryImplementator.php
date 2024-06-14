<?php

namespace App\Repositories\Implementators\Eloquent\Client;

use App\Repositories\Interfaces\Client\OrderRepositoryInterface;

use App\Models\Client\Order;
use App\Models\Client\OrderItems;
use App\DTO\Client\OrderMakeDTO;
use App\DTO\Client\OrderItemsDTO;

class OrderRepositoryImplementator implements OrderRepositoryInterface {
    
    // Order make function
    public function make(OrderMakeDTO $orderDTO): Order {

        // Collect data for order
        $order = [
            'customer_name' => $orderDTO->getCustomerName(),
            'customer_phone' => $orderDTO->getCustomerPhone(),
            'obtaining' => $orderDTO->getObtaining(),
            'address' => $orderDTO->getAddress(),
            'total_price' => $orderDTO->getTotalPrice(),
        ];

        // Create and return order
        return Order::create($order);
    }

    // ===============================================

    // Put order items function
    public function putOrderItems(OrderItemsDTO $orderItemsDTO): void {

        // Gain items from DTO
        $items = $orderItemsDTO->getItems();

        // Create items by cascading it
        foreach($items as $item) {

            // Collect data for item
            $orderItem = [
                'order_id' => $orderItemsDTO->getOrderId(),
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ];

            // Create item
            OrderItems::create($orderItem);
        }
    }
}