<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Post;
use App\Models\Admin\Product;
use App\Models\Staff\Courier;
use App\Models\Client\User;

use App\Http\Requests\Admin\Admin\AdminLoginRequest;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard.index');
    }

    public function login() {
        return view('admin.main.login');
    }

    public function signin(AdminLoginRequest $adminLoginRequest) {
        
    }

    public function posts() {
        $variables = [
            'posts' => Post::all(),
        ];

        return view('admin.dashboard.posts', $variables);
    }

    public function products() {
        $variables = [
            'products' => Product::all(),
        ];

        return view('admin.dashboard.products', $variables);
    }

    public function couriers() {
        $variables = [
            'couriers' => Courier::all(),
        ];

        return view('admin.dashboard.couriers', $variables);
    }

    public function users() {
        $variables = [
            'users' => User::all(),
        ];

        return view('admin.dashboard.users', $variables);
    }
}
