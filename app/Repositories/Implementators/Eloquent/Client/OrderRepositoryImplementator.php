<?php

namespace App\Repositories\Implementators\Eloquent\Client;

use App\Repositories\Interfaces\Client\OrderRepository;
use App\Models\Admin\Product;
use App\Models\Client\Order;
use App\Models\Client\User;
use App\Models\Client\OrderItems;
use App\DTO\Client\Order\OrderCreateDTO;
use App\DTO\Client\Order\OrderItemsDTO;

class OrderRepositoryImplementator implements OrderRepository
{
    // Order make function
    public function make(OrderCreateDTO $orderDTO): Order
    {
        // Collect data for order
        $order = $this->collectOrderParams($orderDTO, 'Preparing');

        $this->putUserData($orderDTO);

        // Create and return order
        return $this->createOrder($order);
    }

    // Put order items function
    public function putOrderItems(OrderItemsDTO $orderItemsDTO): void
    {
        // Gain items from DTO
        $items = $orderItemsDTO->items;

        // Create items by cascading it
        foreach($items as $item) {

            // Collecting item params
            $orderItem = $this->collectItemParams($orderItemsDTO, $item);

            // Create item
            $this->createItem($orderItem);
        }
    }

    // distirbute order
    public function distirbute(int $order_id): void
    {
        // find distributing order
        $order = $this->findOrder($order_id);

        // distribute order
        $this->orderDistirbute($order);
    }

    // delete order
    public function delete(int $order_id): bool
    {
        // find deleting order
        $order = $this->findOrder($order_id);

        // delete order
        return $this->deleteOrder($order);
    }

    // Collect order params
    private function collectOrderParams(OrderCreateDTO $orderDTO, string $status): array
    {
        // Collect order params
        $order = [
            'user_id' => $orderDTO->user_id,
            'obtaining' => $this->obtainingMethod($orderDTO),
            'total_price' => $orderDTO->total_price,
            'additional_price' => $orderDTO->additional_price,
            'status' => $status,
        ];

        // Return order params
        return $order;
    }

    // choice obtaining method
    private function obtainingMethod(OrderCreateDTO $orderDTO): string
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
    private function putUserData(OrderCreateDTO $orderDTO): void
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
    private function createOrder(array $order): Order
    {
        return Order::create($order);
    }

    // Collect item params
    private function collectItemParams(OrderItemsDTO $orderItemsDTO, array $item): array
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
    private function createItem(array $orderItem): void
    {
        OrderItems::create($orderItem);
    }
    
    // distirbute order by obtaining method
    private function orderDistirbute(Order $order): void
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
    private function deleteOrder(Order $order): bool
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
    private function findOrder(int $order_id): Order
    {
        return Order::find($order_id);
    }
}