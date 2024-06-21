<?php

namespace App\Repositories\Implementators\Eloquent\Client;

// Import parent
use App\Repositories\Interfaces\Client\OrderRepositoryInterface;

// Import models
use App\Models\Client\Product;
use App\Models\Client\Order;
use App\Models\Client\OrderItems;

// Import DTO
use App\DTO\Client\Order\OrderCreateDTO;
use App\DTO\Client\Order\OrderItemsDTO;

class OrderRepositoryImplementator implements OrderRepositoryInterface {
    
    // Order make function
    public function make(OrderCreateDTO $orderDTO): Order {

        // Collect data for order
        $order = static::collectOrderParams($orderDTO, 'Preparing');

        // Create and return order
        return static::createOrder($order);
    }

    // ===============================================

    // Put order items function
    public function putOrderItems(OrderItemsDTO $orderItemsDTO): void {

        // Gain items from DTO
        $items = $orderItemsDTO->items;

        // Create items by cascading it
        foreach($items as $item) {

            // Collecting item params
            $orderItem = static::collectItemParams($orderItemsDTO, $item);

            // Create item
            static::createItem($orderItem);
        }
    }

    public function distirbute(int $order_id): void {
        $order = static::findOrder($order_id);

        static::orderDistirbute($order);
    }

    public function delete(int $order_id): bool {
        $order = static::findOrder($order_id);

        return static::deleteOrder($order);
    }

    // ===============================================

    // Collect order params
    public static function collectOrderParams(OrderCreateDTO $orderDTO, string $status): array {
        
        // Collect order params
        $order = [
            'user_id' => $orderDTO->user_id,
            'obtaining' => static::obtainingMethod($orderDTO),
            'total_price' => $orderDTO->total_price,
            'additional_price' => $orderDTO->additional_price,
            'status' => $status,
        ];

        // Return order params
        return $order;
    }

    public static function obtainingMethod(OrderCreateDTO $orderDTO): string {
        if ($orderDTO->obtaining === 'delivery') {
            return $orderDTO->address;
        }

        return $orderDTO->obtaining;
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
            'order_id' => $orderItemsDTO->order_id,
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
    
    public static function findOrder(int $order_id): Order {
        return Order::find($order_id);
    }

    public static function orderDistirbute(Order $order) {

        if ($order->obtaining === 'hall') {
            $order->status = 'Ready';
            $order->save();

        } else if ($order->obtaining === 'pickup') {
            $order->status = 'Your order waiting for you';
            $order->save();

        } else {
            $order->status = 'Your order waiting for courier';
            $order->save();
        }
    }

    public static function deleteOrder(Order $order): bool {
        if ($order->status === 'Preparing') {
            $order->delete();
            return true;
        }

        return false;
    }
}