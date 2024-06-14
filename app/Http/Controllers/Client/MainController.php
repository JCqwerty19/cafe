<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseController;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Post;

class MainController extends BaseController
{
    public function index() {
        $variables = [
            'products' => Product::all(),
            'posts' => Post::all(),
        ];

        return view('client.index', $variables);
    }
}
