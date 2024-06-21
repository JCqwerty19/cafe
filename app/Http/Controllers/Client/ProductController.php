<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Client\Product;

// Import requests
use App\Http\Requests\Client\Product\ProductCreateRequest;
use App\Http\Requests\Client\Product\ProductUpdateRequest;

// Import DTO
use App\DTO\Client\Product\ProductCreateDTO;
use App\DTO\Client\Product\ProductUpdateDTO;

class ProductController extends BaseController
{
    // Create product
    public function create() {

        // Show create product page
        return view('client.product.create');
    }

    // Make product
    public function make(ProductCreateRequest $productCreateRequest) {

        // Validate product request data
        $productData = $productCreateRequest->validated();

        // Create DTO to show params for making product
        $productCreateDTO = new ProductCreateDTO(
            image: $productData['image'],
            title: $productData['title'],
            content: $productData['content'],
            price: $productData['price'],
        );

        // Make product through service
        $this->productService->make($productCreateDTO);
    }

    // Update product
    public function update(Product $product) {

        // Objects for the update product page
        $variables = [
            'product' => $product,
        ];

        // Show product update page
        return view('client.product.update', $variables);
    }

    // Product renew function
    public function renew(ProductUpdateRequest $productUpdateRequest, Product $product) {

        // Validate product update request data
        $productData = $productUpdateRequest->validated();

        // Create DTO to show params for update product
        $productUpdateDTO = new ProductUpdateDTO(
            product_id: $product->id,
            image: $productData['image'],
            title: $productData['title'],
            content: $productData['content'],
            price: $productData['price'],
        );

        // Update product through service
        $this->productService->renew($productUpdateDTO);
    }

    // Delete product
    public function delete(Product $product) {

        // Delete product through service
        $this->productService->delete($product->id);
    }
}