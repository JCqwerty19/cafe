<?php

namespace App\Repositories\Implementators\Eloquent\Staff;

use App\Repositories\Interfaces\Staff\DeliveryRepositoryInterface;

use App\DTO\Staff\DeliveryDTO\DeliveryDTO;

use App\Models\Staff\DeliveryList;

class DeliveryRepositoryImplementator implements DeliveryRepositoryInterface
{
    public function deliver(DeliveryDTO $deliveryDTO) {
        $delivery = static::collectDeliveryData($deliveryDTO);

        static::createDelivery($delivery);
    }

    public static function collectDeliveryData(DeliveryDTO $deliveryDTO): array {
        $delivery = [
            'courier_id' => $deliveryDTO->getCourierId(),
            'order_id' => $deliveryDTO->getOrderId(),
        ];

        return $delivery;
    }

    public static function createDelivery(array $delivery): void {
        DeliveryList::create($delivery);
    }
}