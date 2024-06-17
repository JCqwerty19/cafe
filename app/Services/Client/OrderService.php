<?php

namespace App\Services\Client;

// Import Models
use App\Models\Client\Order;

// Import DTO
use App\DTO\Client\OrderMakeDTO;
use App\DTO\Client\OrderItemsDTO;

use App\Repositories\Interfaces\Client\OrderRepositoryInterface;

class OrderService
{
    // Construction order service
    public function __construct(
        protected OrderRepositoryInterface $orderRepositoryInterface,
    ) {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    // ===============================================

    // Order make function
    public function make(OrderMakeDTO $orderDTO): Order {

        // Create order DTO to show params
        $orderDTO = new OrderMakeDTO(
            customer_name: $orderDTO->getCustomerName(),
            customer_phone: $orderDTO->getCustomerPhone(),
            obtaining: $orderDTO->getObtaining(),
            address: $orderDTO->getAddress(),
            total_price: $orderDTO->getTotalPrice(),
            additional_price: $orderDTO->getAdditionalPrice(),
        );

        // Make order in repository and return
        return $this->getOrderRepositoryInterface()->make($orderDTO);
    }

    // ===============================================

    // Put order items function
    public function putOrderItems(OrderItemsDTO $orderItemsDTO): void {
        
        // Create order items DTO to show params
        $orderItemsDTO = new OrderItemsDTO(
            order_id: $orderItemsDTO->getOrderId(),
            items: $orderItemsDTO->getItems(),
        );

        $this->getOrderRepositoryInterface()->putOrderItems($orderItemsDTO);
    }

    // ===============================================

    // Order Repository Interface getter
    public function getOrderRepositoryInterface(): OrderRepositoryInterface {
        return $this->orderRepositoryInterface;
    }
}