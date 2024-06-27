<?php

namespace App\DTO\Admin\Post;

class PostUpdateDTO
{
    // post update DTO construction
    public function __construct(
        public int $post_id,
        public string|object|null $image,
        public string $title,
        public string $content,
    ) {
        $this->post_id = $post_id;
        $this->title = $title;
        $this->content = $content;
    }
}