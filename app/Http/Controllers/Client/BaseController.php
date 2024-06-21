<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import services
use App\Services\Client\OrderService;
use App\Services\Client\PostService;
use App\Services\Client\UserService;
use App\Services\Client\ProductService;

class BaseController extends Controller
{
    // Construct base for the client side of project
    public function __construct(
        public OrderService $orderService,
        public PostService $postService,
        public UserService $userService,
        public ProductService $productService,
    ) {
        $this->orderService = $orderService;
        $this->postService = $postService;
        $this->userService = $userService;
        $this->productService = $productService;
    }
}
