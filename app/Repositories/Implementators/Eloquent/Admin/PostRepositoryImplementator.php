<?php

namespace App\Repositories\Implementators\Eloquent\Admin;

// Import parent
use App\Repositories\Interfaces\Client\PostRepositoryInterface;

// Import models
use App\Models\Admin\Post;

// Import DTO
use App\DTO\Admin\Post\PostCreateDTO;
use App\DTO\Admin\Post\PostUpdateDTO;

class PostRepositoryImplementator implements PostRepositoryInterface {
    public function make(PostCreateDTO $postCreateDTO): void {
        $postData = static::collectPostParams($postCreateDTO);

        static::createPost($postData);
    }

    public function renew(PostUpdateDTO $postUpdateDTO): void {
        $post = static::findPost($postUpdateDTO->post_id);

        $postNewData = static::collectPostNewParams($postUpdateDTO);

        static::renewPost($post, $postNewData);

    }

    public function delete(int $post_id): void {
        $post = static::findPost($post_id);
        static::postDelete($post);
    }

    // POST MAKE STATIC FUNCTIONS
    // ===================================================

    public static function collectPostParams(PostCreateDTO $postCreateDTO): array {
        $postData = [
            'title' => $postCreateDTO->title,
            'content' => $postCreateDTO->content,
        ];

        return $postData;
    }

    public static function createPost(array $postData): void {
        Post::firstOrCreate($postData);
    }

    // POST RENEW STATIC FUNCTIONS
    // ===================================================

    public static function collectPostNewParams(PostUpdateDTO $postUpdateDTO): array {
        $postNewData = [
            'title' => $postUpdateDTO->title,
            'content' => $postUpdateDTO->content,
        ];

        return $postNewData;
    }

    public static function renewPost(Post $post, array $postNewData): void {
        $post->update($postNewData);
    }

    // POST DELETE STATIC FUNCTIONS
    // ===================================================

    public static function postDelete(Post $post) {
        $post->delete();
    }

    // GENERAL STATIC FUNCTIONS
    // ===================================================
    
    public static function findPost(int $post_id): Post {
        return Post::find($post_id);
    }
    
}