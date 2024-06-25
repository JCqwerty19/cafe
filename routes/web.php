<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes for all
Route::get('/', 'Client\MainController@index')->name('main.index');
Route::get('/post/{post}', 'Admin\PostController@read')->name('post.read');
Route::get('/courier', 'Client\MainController@courier')->name('courier.index');


// =============================================================================================

// Routes for guest clients
Route::group(['prefix' => 'user', 'middleware' => 'guest'], function () {

    // Register routes
    Route::get('/register', 'Client\UserController@register')->name('user.register');
    Route::post('/register', 'Client\UserController@make')->name('user.make');

    // Login routes
    Route::get('/login', 'Client\UserController@login')->name('user.login');
    Route::post('/login', 'Client\UserController@signin')->name('user.signin');
});

// Routes for authorized clients
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {

    // Update routes
    Route::get('/update', 'Client\UserController@update')->name('user.update');
    Route::patch('/update', 'Client\UserController@renew')->name('user.renew');

    // Logout and delete routes
    Route::post('/logout', 'Client\UserController@logout')->name('user.logout');
    Route::delete('/delete/{user}', 'Client\UserController@delete')->name('user.delete');
});

// Routes for client to manage orders
Route::group(['prefix' => 'orders', 'middleware' => 'auth'], function () {

    // Show orders route
    Route::get('/', 'Client\UserController@orders')->name('user.orders');

    // Order create routes
    Route::get('/create', 'Client\OrderController@create')->name('order.create');
    Route::post('/create', 'Client\OrderController@make')->name('order.make');

    // Order delete route
    Route::delete('/delete/{order}', 'Client\OrderController@delete')->name('order.delete');
});


// =============================================================================================


// Routes for guest couriers
Route::group(['prefix' => 'courier', 'middleware' => 'guest'], function () {

    // Register routes
    Route::get('/register', 'Staff\Delivery\CourierController@register')->name('courier.register');
    Route::post('/register', 'Staff\Delivery\CourierController@make')->name('courier.make');

    // Login routes
    Route::get('/login', 'Staff\Delivery\CourierController@login')->name('courier.login');
    Route::post('/login', 'Staff\Delivery\CourierController@signin')->name('courier.signin');
});

// Routes for authorized couriers
Route::group(['prefix' => 'courier', 'middleware' => 'courier'], function () {

    // Update routes
    Route::get('/update', 'Staff\Delivery\CourierController@update')->name('courier.update');
    Route::patch('/update', 'Staff\Delivery\CourierController@renew')->name('courier.renew');

    // Logout and delete routes
    Route::post('/logout', 'Staff\Delivery\CourierController@logout')->name('courier.logout');
    Route::delete('/delete{courier}', 'Staff\Delivery\CourierController@delete')->name('courier.delete');
});

// Routes for couriers to manage deliveries
Route::group(['prefix' => 'delivery', 'middleware' => 'courier'], function () {

    // My deliveries route
    Route::get('/list', 'Staff\Delivery\DeliveryController@list')->name('delivery.list');

    // Deliveries routes
    Route::get('/table', 'Staff\Delivery\DeliveryController@table')->name('delivery.table');
    Route::post('/deliver/{order}', 'Staff\Delivery\DeliveryController@deliver')->name('delivery.deliver');

    // Delivery delete route
    Route::delete('/delete/{order}', 'Staff\Delivery\DeliveryController@delete')->name('delivery.delete');
});


// =============================================================================================


// Routes for kitchen
Route::group(['prefix' => 'kitchen'], function () {

    // Route for kitchen orders tabel
    Route::get('/table', 'Staff\KitchenController@table')->name('kitchen.table');

    // Disterbute order after kitchen route
    Route::post('/distirbute/{order}', 'Client\OrderController@distirbute')->name('order.distribute');
});

// =============================================================================================


// Routes for hall
Route::group(['prefix' => 'hall'], function () {

    // Show hall tables routes
    Route::get('/index', 'Staff\HallController@index')->name('hall.index');
    Route::get('/table', 'Staff\HallController@table')->name('hall.table');
    
});


// =============================================================================================


// Routes for pickup
Route::group(['prefix' => 'pickup'], function () {

    // Pickup order list route
    Route::get('/table', 'Staff\PickupController@table')->name('pickup.table');
});


// =============================================================================================


// Routes for guest admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Admin/AdminController@login')->name('admin.login');
});

// Routes for authorized admin
Route::group(['prefix' => 'admin', 'middlware' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@dashboard')->name('admin.dashboard');

    // Routes for manage posts
    Route::group(['prefix' => 'post'], function () {

        Route::get('/index',  'Admin\AdminController@posts')->name('post.index');

        // Create post
        Route::get('/create', 'Admin\PostController@create')->name('post.create');
        Route::post('/create', 'Admin\PostController@make')->name('post.make');

        // Update post
        Route::get('/update/{post}', 'Admin\PostController@update')->name('post.update');
        Route::patch('/update/{post}', 'Admin\PostController@renew')->name('post.renew');

        // Delete post
        Route::delete('/delete/{post}', 'Admin\PostController@delete')->name('post.delete');
    });

    // Routes for manage products
    Route::group(['prefix' => 'product'], function () {
        Route::get('/index', 'Admin\AdminController@products')->name('product.index');

        // Create post
        Route::get('/create', 'Admin\ProductController@create')->name('product.create');
        Route::post('/create', 'Admin\ProductController@make')->name('product.make');

        // Update post
        Route::get('/update/{product}', 'Admin\ProductController@update')->name('product.update');
        Route::patch('/update/{product}', 'Admin\ProductController@renew')->name('product.renew');

        // Delete post
        Route::delete('/delete/{product}', 'Admin\ProductController@delete')->name('product.delete');
    });

    // Couriers list route
    Route::get('/courier/index', 'Admin\AdminController@couriers')->name('courier.index');

    // Users list route
    Route::get('/users/index', 'Admin\AdminController@users')->name('user.index');    
});

// =============================================================================================

// ==========
// Order price problem
// Restore password
// Confirmation email
// Admin login
// Deletes
// Active orders / deliveries
// Posts manage
// Products create and image
// Order create error to no items
// comments all blade

// updating // the same email   
// ajax