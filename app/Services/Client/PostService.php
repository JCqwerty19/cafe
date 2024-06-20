<?php

namespace App\Services\Client;

// Import repository interface
use App\Repository\Interfaces\Client\PostRepositoryInterface;

// Import DTO
use App\DTO\Client\Post\PostCreateDTO;
use App\DTO\Client\Post\PostUpdateDTO;

class PostService
{
    // Construction order service
    public function __construct(
        public PostRepositoryInterface $postRepositoryInterface,
    ) {
        $this->postRepositoryInterface = $postRepositoryInterface;
    }
    
    // Post make fucntion
    public function make(PostCreateDTO $postCreateDTO) {

        // Create DTO to show params for creating post
        $postCreateDTO = new PostCreateDTO(
            title: $postData->title,
            content: $postData->content,
        );

        // Make post in repository
        $this->postRepositoryInterface->make($postCreateDTO);
    }

    // Post renew fucntion 
    public function renew(PostUpdateDTO $postUpdateDTO) {

        // Create DTO to show params for renew post
        $postUpdateDTO = new PostUpdateDTO(
            post_id: $postUpdateDTO->post_id,
            title: $postUpdateDTO->title,
            content: $postUpdateDTO->content,
        );

        // Renew post in repository
        $this->postRepositoryInterface->renew($postUpdateDTO);
    }

    // Post delete fucntion
    public function delete(int $post_id) {

        // Delete post in repository
        $this->postRepositoryInterface->delete($post_id);
    }
}