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
Route::get('/post/{post}', 'Client\PostController@read')->name('post.read');


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

    // Show orders route
    Route::get('/orders', 'Client\UserController@orders')->name('user.orders');

    // Logout and delete routes
    Route::post('/logout', 'Client\UserController@logout')->name('user.logout');
    Route::delete('/delete/{user}', 'Client\UserController@delete')->name('user.delete');
});

// Routes for client to manage orders
Route::group(['prefix' => 'order', 'middleware' => 'auth'], function () {

    // Order create routes
    Route::get('/', 'Client\OrderController@create')->name('order.create');
    Route::post('/', 'Client\OrderController@make')->name('order.make');

    // Order delete route
    Route::delete('/delete/{order}', 'Client\OrderController@delete')->name('order.delete');
});


// =============================================================================================


// Routes for guest couriers
Route::group(['prefix' => 'courier', 'middleware' => 'guest'], function () {

    // Register routes
    Route::get('/register', 'Staff\DeliveryController@register')->name('delivery.register');
    Route::post('/register', 'Staff\DeliveryController@make')->name('delivery.make');

    // Login routes
    Route::get('/login', 'Staff\DeliveryController@login')->name('delivery.login');
    Route::post('/login', 'Staff\DeliveryController@signin')->name('delivery.signin');
});

// Routes for authorized couriers
Route::group(['prefix' => 'courier', 'middleware' => 'courier'], function () {

    // Update routes
    Route::get('/update', 'Staff\DeliveryController@update')->name('delivery.update');
    Route::patch('/update', 'Staff\DeliveryController@renew')->name('delivery.renew');

    // Logout and delete routes
    Route::post('/logout', 'Staff\DeliveryController@logout')->name('delivery.logout');
    Route::delete('/delete', 'Staff\DeliveryController@delete')->name('delivery.delete');

    // Deliveries routes
    Route::get('/delivery/table', 'Staff\DeliveryController@table')->name('delivery.table');
    Route::post('/delivery/deliver/{order}', 'Staff\DeliveryController@deliver')->name('delivery.deliver');

    // My deliveries route
    Route::get('/delivery/list', 'Staff\DeliveryController@list')->name('delivery.list');
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
    Route::get('/pickup/table', 'Staff\PickupController@table')->name('pickup.table');
});


// =============================================================================================


// Routes for guest admin
Route::group(['prefix' => 'admin'], function () {
    
});

// Routes for authorized admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    // Routes for manage posts
    Route::group(['prefix' => 'post'], function () {

        // Create post
        Route::get('/post/create', 'Client\PostController@create')->name('post.create');
        Route::post('/post/create', 'Client\PostConctroller@make')->name('post.make');

        // Update post
        Route::get('/post/update/{post}', 'Client\PostController@update')->name('post.update');
        Route::patch('/post/update/{post}', 'Client\PostController@renew')->name('post.renew');

        // Delete post
        Route::delete('/post/delete/{post}', 'Client\PostController@delete')->name('post.delete');
    });

    // Routes for manage products
    Route::group(['prefix' => 'product'], function () {

    });
});

// =============================================================================================