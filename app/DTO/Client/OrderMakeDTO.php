<?php

namespace App\DTO\Client;

class OrderMakeDTO
{
    // Construction order make DTO
    public function __construct(
        protected string $customer_name,
        protected string $customer_phone,
        protected string $obtaining,
        protected ?string $address,
        protected int $total_price,
        protected int $additional_price,
    ) {
        $this->customer_name = $customer_name;
        $this->customer_phone = $customer_phone;
        $this->obtaining = $obtaining;
        $this->address = $address;
        $this->total_price = $total_price;
        $this->additional_price = $additional_price;
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
    public function setAddress(string $value): void {
        $this->address = $value;
    }

    // Address getter
    public function getAddress(): ?string {
        return $this->address;
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

    // ===============================================

    public function setAdditionalPrice(int $value): void {
        $this->additional_price = $value;
    }

    // Total price getter
    public function getAdditionalPrice(): int {
        return $this->additional_price;
    }
}