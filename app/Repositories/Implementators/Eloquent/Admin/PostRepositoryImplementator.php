<?php

namespace App\Repositories\Implementators\Eloquent\Admin;

// Import interfaces
use App\Repositories\Interfaces\Admin\PostRepositoryInterface;

// Import models
use App\Models\Admin\Post;

// Import DTO
use App\DTO\Admin\Post\PostCreateDTO;
use App\DTO\Admin\Post\PostUpdateDTO;

class PostRepositoryImplementator implements PostRepositoryInterface
{
    // post make function
    public function make(PostCreateDTO $postCreateDTO): void
    {
        // collect post params from DTO to array
        $postData = static::collectPostParams($postCreateDTO);

        // create post
        static::createPost($postData);
    }


    // =============================================================


    // post renew function
    public function renew(PostUpdateDTO $postUpdateDTO): void
    {
        // find updating post
        $post = static::findPost($postUpdateDTO->post_id);

        // collect new post's params
        $postNewData = static::collectPostNewParams($postUpdateDTO);

        // renew post
        static::renewPost($post, $postNewData);
    }

    
    // =============================================================


    // delete post
    public function delete(int $post_id): void
    {
        // find deleting post
        $post = static::findPost($post_id);

        // delete post
        static::postDelete($post);
    }

    

    // =============================================================
    // STATIC FUNCTIONS
    // =============================================================

    

    // POST MAKE STATIC FUNCTIONS
    // =============================================================


    // collect creating post params
    public static function collectPostParams(PostCreateDTO $postCreateDTO): array
    {
        // collect creating post params in array
        $postData = [
            'title' => $postCreateDTO->title,
            'content' => $postCreateDTO->content,
        ];

        // return array
        return $postData;
    }

    // create post
    public static function createPost(array $postData): void
    {
        Post::firstOrCreate($postData);
    }


    // POST RENEW STATIC FUNCTIONS
    // =============================================================


    // post renew
    public static function renewPost(Post $post, array $postNewData): void
    {
        $post->update($postNewData);
    }

    // POST DELETE STATIC FUNCTIONS
    // ===================================================


    // post delete
    public static function postDelete(Post $post)
    {
        $post->delete();
    }

    // GENERAL STATIC FUNCTIONS
    // ===================================================
    

    // find post
    public static function findPost(int $post_id): Post
    {
        return Post::find($post_id);
    }
}