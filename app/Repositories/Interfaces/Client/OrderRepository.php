<?php

namespace App\Repositories\Interfaces\Client;

use App\Models\Client\Order;
use App\DTO\Client\Order\OrderCreateDTO;
use App\DTO\Client\Order\OrderItemsDTO;

interface OrderRepository
{
    // Order make function
    public function make(OrderCreateDTO $orderDTO): Order;

    // Put order items function
    public function putOrderItems(OrderItemsDTO $orderItemsDTO): void;

    // Distirbute function 
    public function distirbute(int $order_id): void;

    // Delete function
    public function delete(int $order_id): bool;
}