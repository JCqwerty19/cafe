<?php

namespace App\DTO\Client\Post;

class PostUpdateDTO
{
    // Construction post update DTO
    public function __construct(
        public int $post_id,
        public string $title,
        public string $content,
    ) {
        $this->post_id = $post_id;
        $this->title = $title;
        $this->content = $content;
    }
}