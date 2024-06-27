<?php

namespace App\Repositories\Implementators\Eloquent\Client;

use App\Repositories\Interfaces\Client\OrderRepositoryInterface;
use App\Models\Admin\Product;
use App\Models\Client\Order;
use App\Models\Client\User;
use App\Models\Client\OrderItems;
use App\DTO\Client\Order\OrderCreateDTO;
use App\DTO\Client\Order\OrderItemsDTO;

class OrderRepositoryImplementator implements OrderRepositoryInterface
{
    // Order make function
    public function make(OrderCreateDTO $orderDTO): Order
    {
        // Collect data for order
        $order = static::collectOrderParams($orderDTO, 'Preparing');

        static::putUserData($orderDTO);

        // Create and return order
        return static::createOrder($order);
    }

    // Put order items function
    public function putOrderItems(OrderItemsDTO $orderItemsDTO): void
    {
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

    // distirbute order
    public function distirbute(int $order_id): void
    {
        // find distributing order
        $order = static::findOrder($order_id);

        // distribute order
        static::orderDistirbute($order);
    }

    // delete order
    public function delete(int $order_id): bool
    {
        // find deleting order
        $order = static::findOrder($order_id);

        // delete order
        return static::deleteOrder($order);
    }

    // Collect order params
    public static function collectOrderParams(OrderCreateDTO $orderDTO, string $status): array
    {
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

    // choice obtaining method
    public static function obtainingMethod(OrderCreateDTO $orderDTO): string
    {
        // if it's delivery then out address
        if ($orderDTO->obtaining === 'delivery') {
            if (!$orderDTO->address) {
                return "Need to clarify";
            }

            return $orderDTO->address;
        }

        // return obtaining method
        return $orderDTO->obtaining;
    }

    // renew user number and address
    public static function putUserData(OrderCreateDTO $orderDTO): void
    {
        // find user
        $user = User::find($orderDTO->user_id);

        // renew data
        $user->phone = $orderDTO->phone;
        $user->address = $orderDTO->address;

        // save data
        $user->save();
    }

    // Create order
    public static function createOrder(array $order): Order
    {
        return Order::create($order);
    }

    // Collect item params
    public static function collectItemParams(OrderItemsDTO $orderItemsDTO, array $item): array
    {
        // Gain product form DB by id
        $product = Product::find($item['product_id']);

        // Collecting item params
        $orderItem = [
            'order_id' => $orderItemsDTO->order_id,
            'product_id' => $item['product_id'],
            'product_name' => $product->title,
            'quantity' => $item['quantity'],
        ];

        // Return item params
        return $orderItem;
    }

    // Create item
    public static function createItem(array $orderItem): void
    {
        OrderItems::create($orderItem);
    }
    
    // distirbute order by obtaining method
    public static function orderDistirbute(Order $order): void
    {
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

    // delete order if it's just preparing
    public static function deleteOrder(Order $order): bool
    {
        // checking status 
        if ($order->status === 'Preparing') {
            $order->delete();
            return true;
        }

        // return false if order already prepared
        return false;
    }

    // find order
    public static function findOrder(int $order_id): Order
    {
        return Order::find($order_id);
    }
}