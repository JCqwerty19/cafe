<?php

namespace App\Repositories\Interfaces\Staff;

use App\DTO\Staff\DeliveryDTO\DeliveryDTO;

interface DeliveryRepositoryInterface
{
    public function deliver(DeliveryDTO $deliveryDTO);
}