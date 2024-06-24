<?php

namespace App\Repositories\Interfaces\Admin;

// Import DTO
use App\DTO\Admin\Post\PostCreateDTO;
use App\DTO\Admin\Post\PostUpdateDTO;

interface PostRepositoryInterface {

    // Post make function
    public function make(PostCreateDTO $postCreateDTO): void;

    // Post renew function
    public function renew(PostUpdateDTO $postUpdateDTO): void;

    // Post delete function
    public function delete(int $post_id): void;
    
}