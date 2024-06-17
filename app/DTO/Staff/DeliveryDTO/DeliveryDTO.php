<?php

namespace App\DTO\Staff\DeliveryDTO;

class DeliveryDTO
{
    public function __construct(
        protected int $courier_id,
        protected int $order_id,
    ) {
        $this->courier = $courier_id;
        $this->order_id = $order_id;
    }

    // ===============================================

    public function setCourierId(int $value): void {
        $this->courier_id = $value;
    }

    // Obtaining method getter
    public function getCourierId(): int {
        return $this->courier_id;
    }

    public function setOrderId(int $value): void {
        $this->order_id = $value;
    }

    // Obtaining method getter
    public function getOrderId(): int {
        return $this->order_id;
    }

}