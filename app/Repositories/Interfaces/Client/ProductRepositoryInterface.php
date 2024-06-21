<?php

namespace App\Repositories\Interfaces\Client;

// Import DTO
use App\DTO\Client\Product\ProductCreateDTO;
use App\DTO\Client\Product\ProductUpdateDTO;

interface ProductRepositoryInterface {

    // Product make function
    public function make(ProductCreateDTO $productCreateDTO): void;

    // Product renew function
    public function renew(ProductUpdateDTO $productUpdateDTO): void;

    // Product delete function
    public function delete(int $product_id): void;
    
}