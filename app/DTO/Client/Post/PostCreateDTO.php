<?php

namespace App\DTO\Client\Post;

class PostCreateDTO
{
    // Construction post create DTO
    public function __construct(
        public string $title,
        public string $content,
    ) {
        $this->title = $title;
        $this->content = $content;
    }
}