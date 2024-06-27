<?php

namespace App\Repositories\Implementators\Eloquent\Admin;

use App\Repositories\Interfaces\Admin\PostRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Post;
use App\DTO\Admin\Post\PostCreateDTO;
use App\DTO\Admin\Post\PostUpdateDTO;

class PostRepositoryImplementator implements PostRepository
{
    // post make function
    public function make(PostCreateDTO $postCreateDTO): void
    {
        // Recognize image type (if file, then put into storage)
        $postCreateDTO->image = $this->putImage($postCreateDTO->image);

        // collect post params from DTO to array
        $postData = $this->collectPostParams($postCreateDTO);

        // create post
        $this->createPost($postData);
    }

    // post renew function
    public function renew(PostUpdateDTO $postUpdateDTO): void
    {
        // find updating post
        $post = $this->findPost($postUpdateDTO->post_id);

        // Recognize image type (if file, then put into storage)
        $postUpdateDTO->image = $this->putImage($postUpdateDTO->image, $post->image);

        // collect new post's params
        $postNewData = $this->collectPostNewParams($postUpdateDTO);

        // renew post
        $this->renewPost($post, $postNewData);
    }

    // delete post
    public function delete(int $post_id): void
    {
        // find deleting post
        $post = $this->findPost($post_id);

        // delete post
        $this->postDelete($post);
    }

    // collect creating post params
    private function collectPostParams(PostCreateDTO $postCreateDTO): array
    {
        // collect creating post params in array
        $postData = [
            'image' => $postCreateDTO->image,
            'title' => $postCreateDTO->title,
            'content' => $postCreateDTO->content,
        ];

        // return array
        return $postData;
    }

    // create post
    private function createPost(array $postData): void
    {
        Post::firstOrCreate($postData);
    }

    // collect post new params
    private function collectPostNewParams(PostUpdateDTO $postUpdateDTO): array
    {
        // collect data in array from DTO
        $postData = [
            'image' => $postUpdateDTO->image,
            'title' => $postUpdateDTO->title,
            'content' => $postUpdateDTO->content,
        ];

        // return array
        return $postData;
    }

    // post renew
    private function renewPost(Post $post, array $postNewData): void
    {
        $post->update($postNewData);
    }

    // post delete
    private function postDelete(Post $post)
    {
        $post->delete();
    }

    // find post
    private function findPost(int $post_id): Post
    {
        return Post::find($post_id);
    }

    private function putImage(string|object $image = null, string $current = null): string
    {
        if (is_string($image)) {
            return $image;

        } else if (!$image) {
            return $current;
        }

        $image = Storage::putFile('public/admin/images/products', $image);
        return str_replace('public', 'storage', $image);
    }
}