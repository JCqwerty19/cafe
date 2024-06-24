<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// import models
use App\Models\Admin\Post;
use App\Models\Admin\Product;
use App\Models\Client\User;
use App\Models\Staff\Courier;

// import requests
use App\Http\Requests\Admin\Admin\AdminLoginRequest;

// import DTO
use App\DTO\Admin\Admin\AdminLoginDTO;

class AdminController extends Controller
{
    // admin login page
    public function login()
    {
        return view('admin.main.login');
    }


    // =============================================================


    // admin signin function
    public function signin(AdminLoginRequest $adminLoginRequest)
    {
        // validate admin login data
        $adminData = $adminLoginRequest->validate();

        // create DTO to show admin login data
        $adminDTO = new AdminLoginDTO(
            code: $adminData['code'],
            password: $adminData['password'],
        );

        // getting response from loggining admin
        $response = $this->adminService->signin($adminDTO);

        // checking response status if it false then return back with errors
        if (!$response) {
            return back()->withErrors([
                'password' => 'incorrect code or password',
            ]);
        }

        // redirect to the admin dashboard
        return redirect()->route('admin.dashboard');
    }


    // =============================================================


    // dashboard view
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }


    // =============================================================

    
    // posts list view
    public function posts()
    {
        // collect variables
        $variables = [
            'posts' => Post::all(),
        ];

        // show posts view
        return view('admin.dashboard.posts', $variables);
    }


    // =============================================================


    // products list view
    public function products()
    {
        // collect variables
        $variables = [
            'products' => Product::all(),
        ];

        // show products view
        return view('admin.dashboard.products', $variables);
    }


    // =============================================================


    // couriers list view
    public function couriers()
    {
        // collect variables
        $variables = [
            'couriers' => Courier::all(),
        ];

        // show couriers list
        return view('admin.dashboard.couriers', $variables);
    }


    // =============================================================


    // users list view
    public function users()
    {
        // collect variables
        $variables = [
            'users' => User::all(),
        ];

        // show users list
        return view('admin.dashboard.users', $variables);
    }
}
