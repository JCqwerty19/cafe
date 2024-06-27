<?php

namespace App\Repositories\Implementators\Eloquent\Admin;

// Import interfaces
use App\Repositories\Interfaces\Admin\ProductRepositoryInterface;


use Illuminate\Support\Facades\Storage;


// Import models
use App\Models\Admin\Product;

// Import DTO
use App\DTO\Admin\Product\ProductCreateDTO;
use App\DTO\Admin\Product\ProductUpdateDTO;

class ProductRepositoryImplementator implements ProductRepositoryInterface
{
    // product make
    public function make(ProductCreateDTO $productCreateDTO): void
    {
        // Recognize image type (if file, then put into storage)
        $productCreateDTO->image = static::putImage($productCreateDTO->image);

        // collect product data
        $productData = static::collectProductParams($productCreateDTO);

        // create product
        static::createProduct($productData);
    }


    // =============================================================


    // product renew
    public function renew(ProductUpdateDTO $productUpdateDTO): void
    {
        // find updating product
        $product = static::findProduct($productUpdateDTO->product_id);

        // Recognize image type (if file, then put into storage)
        $productUpdateDTO->image = static::putImage($productUpdateDTO->image, $product->image);

        // collect new product data
        $productNewData = static::collectProductNewParams($productUpdateDTO);

        // renew product
        static::renewProduct($product, $productNewData);
    }


    // =============================================================


    // product delete
    public function delete(int $product_id): void
    {
        // find deleting product
        $product = static::findProduct($product_id);

        // delete product
        static::productDelete($product);
    }



    // =============================================================
    // STATIC FUNCTIONS
    // =============================================================



    // PRODUCT MAKE STATIC FUNCTIONS
    // =============================================================


    public static function collectProductParams(ProductCreateDTO $productCreateDTO): array
    {
        // collect data from DTO to array
        $productData = [
            'image' => $productCreateDTO->image,
            'title' => $productCreateDTO->title,
            'content' => $productCreateDTO->content,
            'price' => $productCreateDTO->price,
        ];

        // return array
        return $productData;
    }

    
    // =============================================================


    // create product
    public static function createProduct(array $productData): void
    {
        Product::firstOrCreate($productData);
    }


    // PRODUCT RENEW STATIC FUNCTIONS
    // =============================================================


    // collect product params
    public static function collectProductNewParams(ProductUpdateDTO $productUpdateDTO): array
    {
        // collect data from DTO to array
        $productNewData = [
            'image' => $productUpdateDTO->image,
            'title' => $productUpdateDTO->title,
            'content' => $productUpdateDTO->content,
            'price' => $productUpdateDTO->price,
        ];

        // return array
        return $productNewData;
    }


    // =============================================================


    // renew product
    public static function renewProduct(Product $product, array $productNewData): void
    {
        $product->update($productNewData);
    }


    // PRODUCT DELETE STATIC FUNCTIONS
    // =============================================================


    // product delete
    public static function productDelete(Product $product)
    {
        $product->delete();
    }
    

    // GENERAL STATIC FUNCTIONS
    // =============================================================

    
    // find product
    public static function findProduct(int $product_id): Product
    {
        return Product::find($product_id);
    }

    //

    public static function putImage(string|object|null $image, string $current = null): string
    {
        if (is_string($image)) {
            return $image;

        } else if (!$image) {
            return $current;
        }

        $image = Storage::putFile('public/admin/images/products', $image);
        return str_replace('public', 'storage', $image);
    }
    
}