<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Client\OrderService;

class BaseController extends Controller
{
    // Client base controller constructor
    public function __construct(
        protected OrderService $orderService,
    ) {
        $this->orderService = $orderService;
    }

    // Order service getter
    public function getOrderService() {
        return $this->orderService;
    }
}
