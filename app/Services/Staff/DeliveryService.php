<?php

namespace App\Services\Staff;

use App\Repositories\Interfaces\Staff\DeliveryRepository;

class DeliveryService
{
    public function __construct(
        public DeliveryRepository $deliveryRepository
    ) {
        $this->deliveryRepository = $deliveryRepository;
    }

    // deliver order to courier delivery list
    public function deliver(int $order_id): void
    {
        $this->deliveryRepository->deliver($order_id);
    }
}