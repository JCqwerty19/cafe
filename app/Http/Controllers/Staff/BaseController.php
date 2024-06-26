<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Staff\DeliveryService;
use App\Services\Staff\CourierService;

class BaseController extends Controller
{
    // Construct base for the staff side of project
    public function __construct(
        public DeliveryService $deliveryService,
        public CourierService $courierService,
    ) {
        $this->deliveryService = $deliveryService;
        $this->courierService = $courierService;
    }
}
