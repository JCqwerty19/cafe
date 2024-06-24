<?php

namespace App\DTO\Client\Product;

class ProductUpdateDTO
{
    // Construction product update DTO
    public function __construct(
        public int $product_id,
        public string $image,
        public string $title,
        public string $content,
        public int $price,
    ) {
        $this->product_id = $product_id;
        $this->image = $image;
        $this->title = $title;
        $this->content = $content;
        $this->price = $price;
    }
}