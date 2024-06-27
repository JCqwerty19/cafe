<?php

namespace App\Repositories\Interfaces\Staff;

interface DeliveryRepository
{
    // Order deliver function
    public function deliver(int $order_id): void;
}