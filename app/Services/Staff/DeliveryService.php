<?php

namespace App\Services\Staff;

use App\Repositories\Interfaces\Staff\DeliveryRepositoryInterface;

class DeliveryService
{
    public function __construct(
        public DeliveryRepositoryInterface $deliveryRepositoryInterface
    ) {
        $this->deliveryRepositoryInterface = $deliveryRepositoryInterface;
    }

    // deliver order to courier delivery list
    public function deliver(int $order_id): void
    {
        $this->deliveryRepositoryInterface->deliver($order_id);
    }
}