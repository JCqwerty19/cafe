<?php

namespace App\Services\Staff;

use App\Repositories\Interfaces\Staff\DistributionRepositoryInterface;

class DistributionService {

    // Construction order service
    public function __construct(
        protected DistributionRepositoryInterface $distributionRepositoryInterface,
    ) {
        $this->distributionRepositoryInterface = $distributionRepositoryInterface;
    }


    public function distribute(DistributeDTO $orderDTO) {
        $orderDTO = new DistributeDTO(
            customer_name: $orderDTO->getCustomerName(),
            customer_phone: $orderDTO->getCustomerPhone(),
            obtaining: $orderDTO->getObtaining(),
            total_price: $orderDTO->getTotalPrice(),
            status: $orderDTO->getStatus(),
        );

        $this->getDistributionRepositoryInterface()->distribute($orderDTO);
    }

    public function getDistributionRepositoryInterface() {
        return $this->distributionRepositoryInterface;
    }
}