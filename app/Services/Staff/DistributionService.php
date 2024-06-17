<?php

namespace App\Services\Staff;

use App\Repositories\Interfaces\Staff\DistributionRepositoryInterface;

use App\DTO\Staff\DistributeDTO;

class DistributionService {

    // Construction order service
    public function __construct(
        protected DistributionRepositoryInterface $distributionRepositoryInterface,
    ) {
        $this->distributionRepositoryInterface = $distributionRepositoryInterface;
    }


    public function distribute(DistributeDTO $orderDTO) {
        $orderDTO = new DistributeDTO(
            order_id: $orderDTO->getOrderId(),
            obtaining: $orderDTO->getObtaining(),
            status: $orderDTO->getStatus(),
        );

        $this->getDistributionRepositoryInterface()->distribute($orderDTO);
    }

    public function getDistributionRepositoryInterface() {
        return $this->distributionRepositoryInterface;
    }
}