<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Admin\Product;

// Import requests
use App\Http\Requests\Admin\Product\ProductCreateRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;

// Import DTO
use App\DTO\Admin\Product\ProductCreateDTO;
use App\DTO\Admin\Product\ProductUpdateDTO;

class ProductController extends BaseController
{
    // Create product
    public function create()
    {
        // Show create product page
        return view('admin.product.create');
    }


    // =============================================================


    // Make product
    public function make(ProductCreateRequest $productCreateRequest)
    {
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

        // retirect to the products table
        return redirect()->route('products.index');
    }


    // =============================================================


    // Update product
    public function update(Product $product)
    {
        // Objects for the update product page
        $variables = [
            'product' => $product,
        ];

        // Show product update page
        return view('admin.product.update', $variables);
    }


    // =============================================================


    // Product renew function
    public function renew(ProductUpdateRequest $productUpdateRequest, Product $product)
    {
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

        // retirect to the products table
        return redirect()->route('products.index');
    }


    // =============================================================
    

    // Delete product
    public function delete(Product $product)
    {
        // Delete product through service
        $this->productService->delete($product->id);

        // retirect to the products table
        return redirect()->route('products.index');
    }
}