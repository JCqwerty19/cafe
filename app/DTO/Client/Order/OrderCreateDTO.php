<?php

namespace App\DTO\Client\Order;

class OrderCreateDTO
{
    // Construction order create DTO
    public function __construct(
        public int $user_id,
        public string $obtaining,
        public ?string $address,
        public int $total_price,
        public int $additional_price,
    ) {
        $this->user_id = $user_id;
        $this->obtaining = $obtaining;
        $this->address = $address;
        $this->total_price = $total_price;
        $this->additional_price = $additional_price;
    }
}