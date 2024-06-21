<?php

namespace App\Repositories\Implementators\Eloquent\Client;

// Import parent
use App\Repositories\Interfaces\Client\ProductRepositoryInterface;

// Import models
use App\Models\Client\Product;

// Import DTO
use App\DTO\Client\Product\ProductCreateDTO;
use App\DTO\Client\Product\ProductUpdateDTO;

class ProductRepositoryImplementator implements ProductRepositoryInterface {
    public function make(ProductCreateDTO $productCreateDTO): void {
        $productData = static::collectProductParams($productCreateDTO);

        static::createProduct($productData);
    }

    public function renew(ProductUpdateDTO $productUpdateDTO): void {
        $product = static::findProduct($productUpdateDTO->product_id);

        $productNewData = static::collectProductNewParams($productUpdateDTO);

        static::renewProduct($product, $productNewData);

    }

    public function delete(int $product_id): void {
        $product = static::findProduct($product_id);
        static::productDelete($product);
    }

    // POST MAKE STATIC FUNCTIONS
    // ===================================================

    public static function collectProductParams(ProductCreateDTO $productCreateDTO): array {
        $productData = [
            'image' => $productCreateDTO->image,
            'title' => $productCreateDTO->title,
            'content' => $productCreateDTO->content,
            'price' => $productCreateDTO->price,
        ];

        return $productData;
    }

    public static function createProduct(array $productData): void {
        Product::firstOrCreate($productData);
    }

    // POST RENEW STATIC FUNCTIONS
    // ===================================================

    public static function collectProductNewParams(ProductUpdateDTO $productUpdateDTO): array {
        $productNewData = [
            'image' => $productUpdateDTO->image,
            'title' => $productUpdateDTO->title,
            'content' => $productUpdateDTO->content,
            'price' => $productUpdateDTO->price,
        ];

        return $productNewData;
    }

    public static function renewProduct(Product $product, array $productNewData): void {
        $product->update($productNewData);
    }

    // POST DELETE STATIC FUNCTIONS
    // ===================================================

    public static function productDelete(Product $product) {
        $product->delete();
    }

    // GENERAL STATIC FUNCTIONS
    // ===================================================
    
    public static function findProduct(int $product_id): Product {
        return Product::find($product_id);
    }
    
}