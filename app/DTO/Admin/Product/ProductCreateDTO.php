<?php

namespace App\DTO\Admin\Product;

class ProductCreateDTO
{
    // product create DTO construction
    public function __construct(
        public string $image,
        public string $title,
        public string $content,
        public int $price,
    ) {
        $this->image = $image;
        $this->title = $title;
        $this->content = $content;
        $this->price = $price;
    }
}