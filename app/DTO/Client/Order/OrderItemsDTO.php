<?php

namespace App\DTO\Client\Order;

class OrderItemsDTO {

    // order update DTO construction
    public function __construct(
        public int $order_id,
        public array $items,
    ) {
        $this->order_id = $order_id;
        $this->items = $items;
    }
}