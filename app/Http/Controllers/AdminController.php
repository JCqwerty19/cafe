<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client\Post;
use App\Models\Client\Product;
use App\Models\Staff\Courier;
use App\Models\User;

class AdminController extends Controller
{
    public function admin() {
        return view('admin.index');
    }

    public function posts() {
        $variables = [
            'posts' => Post::all(),
        ];

        return view('admin.posts', $variables);
    }

    public function products() {
        $variables = [
            'products' => Product::all(),
        ];

        return view('admin.products', $variables);
    }

    public function couriers() {
        $variables = [
            'couriers' => Courier::all(),
        ];

        return view('admin.couriers', $variables);
    }

    public function users() {
        $variables = [
            'users' => User::all(),
        ];

        return view('admin.users', $variables);
    }
}
