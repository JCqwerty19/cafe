<?php

namespace App\DTO\Admin\Product;

class ProductCreateDTO
{
    // Construction product create DTO
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