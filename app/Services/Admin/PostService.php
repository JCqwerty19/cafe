<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\PostRepository;
use App\DTO\Admin\Post\PostCreateDTO;
use App\DTO\Admin\Post\PostUpdateDTO;

class PostService
{
    // Construction order service
    public function __construct(
        public PostRepository $postRepository,
    ) {
        $this->postRepository = $postRepository;
    }

    // Post make fucntion
    public function make(PostCreateDTO $postCreateDTO): void
    {
        // Create DTO to show params for creating post
        $postCreateDTO = new PostCreateDTO(
            image: $postCreateDTO->image,
            title: $postCreateDTO->title,
            content: $postCreateDTO->content,
        );

        // Make post in repository
        $this->postRepository->make($postCreateDTO);
    }

    // Post renew fucntion 
    public function renew(PostUpdateDTO $postUpdateDTO): void
    {
        // Create DTO to show params for renew post
        $postUpdateDTO = new PostUpdateDTO(
            post_id: $postUpdateDTO->post_id,
            image: $postUpdateDTO->image,
            title: $postUpdateDTO->title,
            content: $postUpdateDTO->content,
        );

        // Renew post in repository
        $this->postRepository->renew($postUpdateDTO);
    }

    // Post delete fucntion
    public function delete(int $post_id): void
    {
        $this->postRepository->delete($post_id);
    }
}