<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\PostService;
use App\Services\Admin\ProductService;

class BaseController extends Controller
{
    // admin base constroller construction
    public function __construct(
        public PostService $postService,
        public ProductService $productService,
    ) {
        $this->postService = $postService;
        $this->productService = $productService;
    }
}
