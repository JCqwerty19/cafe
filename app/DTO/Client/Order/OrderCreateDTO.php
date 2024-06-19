<?php

namespace App\DTO\Client;

class OrderMakeDTO
{
    // Construction order create DTO
    public function __construct(
        public string $customer_name,
        public string $customer_phone,
        public string $obtaining,
        public ?string $address,
        public int $total_price,
        public int $additional_price,
    ) {
        $this->customer_name = $customer_name;
        $this->customer_phone = $customer_phone;
        $this->obtaining = $obtaining;
        $this->address = $address;
        $this->total_price = $total_price;
        $this->additional_price = $additional_price;
    }
}