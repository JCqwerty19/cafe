<?php

namespace App\DTO\Admin\Post;

class PostCreateDTO
{
    // post create DTO construction
    public function __construct(
        public string|object $image, 
        public string $title,
        public string $content,
    ) {
        $this->title = $title;
        $this->content = $content;
    }
}