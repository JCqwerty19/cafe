<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\ProductRepository;
use App\DTO\Admin\Product\ProductCreateDTO;
use App\DTO\Admin\Product\ProductUpdateDTO;

class ProductService
{
    // Construction order service
    public function __construct(
        public ProductRepository $productRepository,
    ) {
        $this->productRepository = $productRepository;
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
        $this->productRepository->make($productCreateDTO);
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
        $this->productRepository->renew($productUpdateDTO);
    }

    // Product delete fucntion
    public function delete(int $product_id): void
    {
        $this->productRepository->delete($product_id);
    }
}