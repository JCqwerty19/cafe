<?php

namespace App\Repositories\Interfaces\Staff;

use App\DTO\Staff\DistributeDTO;

interface DistributionRepositoryInterface
{
    public function distribute(DistributeDTO $orderDTO);
}