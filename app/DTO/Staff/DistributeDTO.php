<?php

namespace App\DTO\Staff;

class DistributeDTO
{
    public function __construct(
        protected string $customer_name,
        protected string $customer_phone,
        protected string $obtaining,
        protected int $total_price,
        protected string $status,
    ) {
        $this->customer_name = $customer_name;
        $this->customer_phone = $customer_phone;
        $this->obtaining = $obtaining;
        $this->total_price = $total_price;
        $this->status = $status;
    }

    // ===============================================

    // Customer name setter
    public function setCustomerName(string $value): void {
        $this->customer_name = $value;
    }

    // Customer name getter
    public function getCustomerName(): string {
        return $this->customer_name;
    }

    // ===============================================

    // Customer phone setter
    public function setCustomerPhone(string $value): void {
        $this->customer_phone = $value;
    }

    // Customer phone getter
    public function getCustomerPhone(): string {
        return $this->customer_phone;
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

    // Address setter
    public function setStatus(string $value): void {
        $this->status = $value;
    }

    // Address getter
    public function getStatus(): ?string {
        return $this->status;
    }

    // ===============================================

    // Total price setter
    public function setTotalPrice(int $value): void {
        $this->total_price = $value;
    }

    // Total price getter
    public function getTotalPrice(): int {
        return $this->total_price;
    }
}