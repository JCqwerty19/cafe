<?php

namespace App\DTO\Client\Post;

class PostCreateDTO
{
    public function __construct(
        public string $title,
        public string $content,
    ) {
        $this->title = $title;
        $this->content = $content;
    }
}