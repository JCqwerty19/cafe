<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Post;

class MainController extends Controller
{
    public function index() {
        $variables = [
            'products' => Product::all(),
            'posts' => Post::all(),
        ];

        return view('client.index', $variables);
    }
}
