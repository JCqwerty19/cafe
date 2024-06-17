<?php

namespace App\DTO\Staff;

class DistributeDTO
{
    public function __construct(
        protected int $order_id ,
        protected string $obtaining,
        protected string $status,
    ) {
        $this->order_id = $order_id;
        $this->obtaining = $obtaining;
        $this->status = $status;
    }

    // ===============================================

    // ID setter
    public function setOrderId(int $value): void {
        $this->order_id = $value;
    }

    // ID getter
    public function getOrderId(): int {
        return $this->order_id;
    }


    // ===============================================
    
    // Obtaining method setter
    public function setObtaining(string $value): void {
        $this->obtaining = $value;
    }

    // Obtaining method getter
    public function getObtaining(): string {
        return $this->obtaining;
    }

    // ===============================================

    // Status setter
    public function setStatus(string $value): void {
        $this->status = $value;
    }

    // Status getter
    public function getStatus(): string {
        return $this->status;
    }
}