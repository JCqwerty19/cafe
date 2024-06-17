<?php

namespace App\Services\Staff;

use App\Repositories\Interfaces\Staff\DeliveryRepositoryInterface;

use App\DTO\Staff\DeliveryDTO\DeliveryDTO;

class DeliveryService
{
    public function __construct(
        protected DeliveryRepositoryInterface $deliveryRepositoryInterface
    ) {
        $this->deliveryRepositoryInterface = $deliveryRepositoryInterface;
    }

    public function deliver(DeliveryDTO $deliveryDTO) {
        $deliveryDTO = new DeliveryDTO(
            courier_id: $deliveryDTO->getCourierId(),
            order_id: $deliveryDTO->getOrderId(),
        );

        $this->getDeliveryRepositoryInterface()->deliver($deliveryDTO);
    }

    public function getDeliveryRepositoryInterface(): DeliveryRepositoryInterface {
        return $this->deliveryRepositoryInterface;
    }
}