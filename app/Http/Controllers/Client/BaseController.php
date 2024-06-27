<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Client\OrderService;
use App\Services\Client\UserService;

class BaseController extends Controller
{
    // Construct base for the client side of project
    public function __construct(
        public OrderService $orderService,
        public UserService $userService,
    ) {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }
}
