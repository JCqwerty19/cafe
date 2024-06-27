<?php

namespace App\Repositories\Implementators\Eloquent\Admin;

use App\Repositories\Interfaces\Admin\ProductRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Product;
use App\DTO\Admin\Product\ProductCreateDTO;
use App\DTO\Admin\Product\ProductUpdateDTO;

class ProductRepositoryImplementator implements ProductRepository
{
    // product make
    public function make(ProductCreateDTO $productCreateDTO): void
    {
        // Recognize image type (if file, then put into storage)
        $productCreateDTO->image = $this->putImage($productCreateDTO->image);

        // collect product data
        $productData = $this->collectProductParams($productCreateDTO);

        // create product
        $this->createProduct($productData);
    }

    // product renew
    public function renew(ProductUpdateDTO $productUpdateDTO): void
    {
        // find updating product
        $product = $this->findProduct($productUpdateDTO->product_id);

        // Recognize image type (if file, then put into storage)
        $productUpdateDTO->image = $this->putImage($productUpdateDTO->image, $product->image);

        // collect new product data
        $productNewData = $this->collectProductNewParams($productUpdateDTO);

        // renew product
        $this->renewProduct($product, $productNewData);
    }

    // product delete
    public function delete(int $product_id): void
    {
        // find deleting product
        $product = $this->findProduct($product_id);

        // delete product
        $this->productDelete($product);
    }

    private function collectProductParams(ProductCreateDTO $productCreateDTO): array
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

    // create product
    private function createProduct(array $productData): void
    {
        Product::firstOrCreate($productData);
    }

    // collect product params
    private function collectProductNewParams(ProductUpdateDTO $productUpdateDTO): array
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

    // renew product
    private function renewProduct(Product $product, array $productNewData): void
    {
        $product->update($productNewData);
    }

    // product delete
    private function productDelete(Product $product)
    {
        $product->delete();
    }
    
    // find product
    private function findProduct(int $product_id): Product
    {
        return Product::find($product_id);
    }

    // put image function
    private function putImage(string|object|null $image, string $current = null): string
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