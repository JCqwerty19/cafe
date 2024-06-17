<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Staff\DistributionService;
use App\Services\Staff\DeliveryService;

class BaseController extends Controller
{
    // Staff base controller constructor
    public function __construct(
        protected DistributionService $distributionService,
        protected DeliveryService $deliveryService,
    ) {
        $this->distributionService = $distributionService;
        $this->deliveryService = $deliveryService;
    }

    // Distribution service getter
    public function getDistributionService(): DistributionService {
        return $this->distributionService;
    }

    public function getDeliverySerivce(): DeliveryService {
        return $this->deliveryService;
    }
}
