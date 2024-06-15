<?php

namespace App\Repositories\Implementators\Eloquent\Client;

// Import parent
use App\Repositories\Interfaces\Client\OrderRepositoryInterface;

// Import models
use App\Models\Product;
use App\Models\Client\Order;
use App\Models\Client\OrderItems;

// Import DTO
use App\DTO\Client\OrderMakeDTO;
use App\DTO\Client\OrderItemsDTO;

class OrderRepositoryImplementator implements OrderRepositoryInterface {
    
    // Order make function
    public function make(OrderMakeDTO $orderDTO): Order {

        // Collect data for order
        $order = static::collectOrderParams($orderDTO);

        // Create and return order
        return static::createOrder($order);
    }

    // ===============================================

    // Put order items function
    public function putOrderItems(OrderItemsDTO $orderItemsDTO): void {

        // Gain items from DTO
        $items = $orderItemsDTO->getItems();

        // Create items by cascading it
        foreach($items as $item) {

            // Collecting item params
            $orderItem = static::collectItemParams($orderItemsDTO, $item);

            // Create item
            static::createItem($orderItem);
        }

    }

    // ===============================================

    // Collect order params
    public static function collectOrderParams(OrderMakeDTO $orderDTO): array {
        
        // Collect order params
        $order = [
            'customer_name' => $orderDTO->getCustomerName(),
            'customer_phone' => $orderDTO->getCustomerPhone(),
            'obtaining' => $orderDTO->getObtaining(),
            'address' => $orderDTO->getAddress(),
            'total_price' => $orderDTO->getTotalPrice(),
            'status' => 'new_order',
        ];

        // Return order params
        return $order;
    }

    // Create order
    public static function createOrder(array $order): Order {

        // Create and return order
        return Order::create($order);
    }

    // ===============================================

    // Collect item params
    public static function collectItemParams(OrderItemsDTO $orderItemsDTO, array $item): array {

        // Gain product form DB by id
        $product = Product::find($item['product_id']);

        // Collecting item params
        $orderItem = [
            'order_id' => $orderItemsDTO->getOrderId(),
            'product_id' => $item['product_id'],
            'product_name' => $product->name,
            'quantity' => $item['quantity'],
        ];

        // Return item params
        return $orderItem;
    }

    // Create item
    public static function createItem(array $orderItem): void {

        // Create item
        OrderItems::create($orderItem);
    }
    
}