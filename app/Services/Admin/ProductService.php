<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\ProductRepositoryInterface;
use App\DTO\Admin\Product\ProductCreateDTO;
use App\DTO\Admin\Product\ProductUpdateDTO;

class ProductService
{
    // Construction order service
    public function __construct(
        public ProductRepositoryInterface $productRepositoryInterface,
    ) {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    // Product make fucntion
    public function make(ProductCreateDTO $productCreateDTO): void
    {
        // Create DTO to show params for creating product
        $productCreateDTO = new ProductCreateDTO(
            image: $productCreateDTO->image,
            title: $productCreateDTO->title,
            content: $productCreateDTO->content,
            price: $productCreateDTO->price,
        );

        // Make product in repository
        $this->productRepositoryInterface->make($productCreateDTO);
    }

    // Product renew fucntion 
    public function renew(ProductUpdateDTO $productUpdateDTO): void
    {
        // Create DTO to show params for renew product
        $productUpdateDTO = new ProductUpdateDTO(
            product_id: $productUpdateDTO->product_id,
            image: $productUpdateDTO->image,
            title: $productUpdateDTO->title,
            content: $productUpdateDTO->content,
            price: $productUpdateDTO->price,
        );

        // Renew product in repository
        $this->productRepositoryInterface->renew($productUpdateDTO);
    }

    // Product delete fucntion
    public function delete(int $product_id): void
    {
        $this->productRepositoryInterface->delete($product_id);
    }
}