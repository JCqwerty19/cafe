<?php

namespace App\Services\Client;

// Import repository interface
use App\Repositories\Interfaces\Client\OrderRepositoryInterface;

// Import Models
use App\Models\Client\Order;

// Import DTO
use App\DTO\Client\Order\OrderCreateDTO;
use App\DTO\Client\Order\OrderItemsDTO;

class OrderService
{
    // Construction order service
    public function __construct(
        public OrderRepositoryInterface $orderRepositoryInterface,
    ) {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    // ===============================================

    // Order make function
    public function make(OrderCreateDTO $orderDTO): Order {

        // Create order DTO to show params
        $orderDTO = new OrderCreateDTO(
            user_id: $orderDTO->user_id,
            obtaining: $orderDTO->obtaining,
            phone: $orderDTO->phone,
            address: $orderDTO->address,
            total_price: $orderDTO->total_price,
            additional_price: $orderDTO->additional_price,
        );

        // Make order in repository and return
        return $this->orderRepositoryInterface->make($orderDTO);
    }

    // ===============================================

    // Put order items function
    public function putOrderItems(OrderItemsDTO $orderItemsDTO): void {
        
        // Create order items DTO to show params
        $orderItemsDTO = new OrderItemsDTO(
            order_id: $orderItemsDTO->order_id,
            items: $orderItemsDTO->items,
        );

        // Put order items in repository
        $this->orderRepositoryInterface->putOrderItems($orderItemsDTO);
    }

    // Duistirbute orders function
    public function distirbute(int $order_id): void {

        // Distirbute order in repository
        $this->orderRepositoryInterface->distirbute($order_id);
    }

    // Delete order fucntion
    public function delete(int $order_id): bool {

        // Delete order in repository
        return $this->orderRepositoryInterface->delete($order_id);
    }
}