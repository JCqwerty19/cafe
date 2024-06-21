<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Client\Product;
use App\Models\Client\Post;

class MainController extends BaseController
{
    // Show main page
    public function index() {

        // Objects for the main page
        $variables = [
            'products' => Product::all(),
            'posts' => Post::all(),
        ];

        // Show main page
        return view('client.main.index', $variables);
    }

    // Show main page for staff
    public function courier() {

        // Show main page for staff
        return view('staff.main.index');
    }
}