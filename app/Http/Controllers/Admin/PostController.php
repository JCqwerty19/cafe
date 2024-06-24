<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

// import models
use App\Models\Admin\Post;

// import requests
use App\Http\Requests\Admin\Post\PostCreateRequest;
use App\Http\Requests\Admin\Post\PostUpdateRequest;

// import DTO
use App\DTO\Admin\Post\PostCreateDTO;
use App\DTO\Admin\Post\PostUpdateDTO;

class PostController extends BaseController
{
    // create post view
    public function create()
    {
        return view('admin.post.create');
    }


    // =============================================================


    // make post
    public function make(PostCreateRequest $postCreateRequest)
    {
        // validate post request data
        $postData = $postCreateRequest->validated();

        // create DTO to show params for making post
        $postCreateDTO = new PostCreateDTO(
            title: $postData['title'],
            content: $postData['content'],
        );

        // make post through service
        $this->postService->make($postCreateDTO);
    }


    // =============================================================


    // Read post
    public function read(Post $post)
    {
        // Objects for the post page
        $variables = [
            'post' => Post::find($post->id),
            'posts' => Post::all(),
        ];

        // Show post page
        return view('admin.post.read', $variables);
    }


    // =============================================================


    // Update post
    public function update(Post $post)
    {
        // Objects for the update post page
        $variables = [
            'post' => $post,
        ];

        // Show post update page
        return view('admin.post.update', $variables);
    }


    // =============================================================
    

    // Post renew function
    public function renew(PostUpdateRequest $postUpdateRequest, Post $post)
    {
        // Validate post update request data
        $postData = $postUpdateRequest->validated();

        // Create DTO to show params for update post
        $postUpdateDTO = new PostUpdateDTO(
            post_id: $post->id,
            title: $postData['title'],
            content: $postData['content'],
        );

        // Update post through service
        $this->postService->renew($postUpdateDTO);
    }


    // =============================================================


    // Delete post
    public function delete(Post $post)
    {
        // Delete post through service
        $this->postService->delete($post->id);
    }
}