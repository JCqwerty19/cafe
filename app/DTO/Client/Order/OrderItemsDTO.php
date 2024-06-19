<?php

namespace App\DTO\Client;

class OrderItemsDTO {

    // Construction order items DTO
    public function __construct(
        protected int $order_id,
        protected array $items,
    ) {
        $this->order_id = $order_id;
        $this->items = $items;
    }

    // ===============================================

    // Order id setter
    public function setOrderId(int $value): void {
        $this->order_id = $value;
    }

    // Order id getter
    public function getOrderId(): int {
        return $this->order_id;
    }

    // ===============================================

    // Product id setter
    public function setItems(array $value): void {
        $this->items = $value;
    }

    // Product id getter
    public function getItems(): array {
        return $this->items;
    }
}