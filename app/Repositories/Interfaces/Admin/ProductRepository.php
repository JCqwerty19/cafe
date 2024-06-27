<?php

namespace App\Repositories\Interfaces\Admin;

use App\DTO\Admin\Product\ProductCreateDTO;
use App\DTO\Admin\Product\ProductUpdateDTO;

interface ProductRepository
{

    // Product make function
    public function make(ProductCreateDTO $productCreateDTO): void;

    // Product renew function
    public function renew(ProductUpdateDTO $productUpdateDTO): void;

    // Product delete function
    public function delete(int $product_id): void;
    
}