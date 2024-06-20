<?php

namespace App\Repositories\Interfaces\Client;

// Import DTO
use App\DTO\Client\Post\PostCreateDTO;
use App\DTO\Client\Post\PostUpdateDTO;

interface PostRepositoryInterface {

    // Post make function
    public function make(PostCreateDTO $postCreateDTO): void;

    // Post renew function
    public function renew(PostUpdateDTO $postUpdateDTO): void;

    // Post delete function
    public function delete(int $post_id): void;
    
}