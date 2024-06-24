<?php

namespace App\Repositories\Interfaces\Staff;

interface DeliveryRepositoryInterface
{
    // Order deliver function
    public function deliver(int $order_id): void;
}