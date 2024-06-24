<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import services
use App\Services\Admin\PostService;
use App\Services\Admin\ProductService;

class BaseController extends Controller
{
    
    public function __construct(
        public PostService $postService,
        public ProductService $productService,
    ) {
        $this->postService = $postService;
        $this->productService = $productService;
    }
}
