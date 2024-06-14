<?php

namespace App\Repositories\Interfaces\Client;

// Import Models
use App\Models\Client\Order;

// Import DTO
use App\DTO\Client\OrderMakeDTO;
use App\DTO\Client\OrderItemsDTO;

interface OrderRepositoryInterface {
    
    // Order make function
    public function make(OrderMakeDTO $orderDTO): Order;

    // Put order items function
    public function putOrderItems(OrderItemsDTO $orderItemsDTO);
}