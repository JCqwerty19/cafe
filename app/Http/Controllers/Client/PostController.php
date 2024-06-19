<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Client\Post;

// Import DTO
use App\DTO\Client\Post\PostCreateDTO;
use App\DTO\Client\Post\PostUpdateDTO;

// Import requests
use App\Http\Requests\Client\Post\PostCreateRequest;
use App\Http\Requests\Client\Post\PostUpdateRequest;

class PostController extends BaseController
{
    // Create post
    public function create() {

        // Show create post page
        return view('client.post.create');
    }

    // Make post
    public function make(PostCreateRequest $postCreateRequest) {

        // Validate post request data
        $postData = $postCreateRequest->validated();

        // Create DTO to show params for making post
        $postCreateDTO = new PostCreateDTO(
            title: $postData->title,
            content: $postData->content,
        );

        // Make post through service
        $this->postService->make($postCreateDTO);
    }

    // Read post
    public function read(Post $post) {

        // Objects for the post page
        $variables = [
            'post' => Post::find($post->id),
            'posts' => Post::all(),
        ];

        // Show post page
        return view('client.post.read', $variables);
    }

    // Update post
    public function update(Post $post) {

        // Objects for the update post page
        $variables = [
            'post' => $post,
        ];

        // Show post update page
        return view('client.post.update', $variables);
    }

    public function renew(PostUpdateRequest $postUpdateRequest, Post $post) {

        // Validate post update request data
        $postData = $postCreateRequest->validated();

        // Create DTO to show params for update post
        $postUpdateDTO = new PostUpdateDTO(
            post_id: $post->id,
            title: $postData['title'],
            content: $postData['content'],
        );

        // Update post through service
        $this->postService->renew($postUpdateDTO);
    }

    // Delete post
    public function delete(Post $post) {

        // Delete post through service
        $this->postService->delete($post);
    }
}
