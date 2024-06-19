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

Route::get('/', 'Client/MainController@index')->name('main.index');
Route::get('/post/{post}', 'Client/PostController@read')->name('post.read');

Route::group(['prefix' => 'user', 'middleware' => 'guest'], function () {
    

    Route::get('/register', 'Client/UserController@register')->name('user.register');
    Route::post('/register', 'Client/UserController@make')->name('user.register');

    Route::get('/login', 'Client/UserController@login')->name('user.login');
    Route::post('/login', 'Client/UserController@signin')->name('user.signin');

    Route::get('/delivery/register', 'Staff/DeliveryController@register')->name('delivery.register');
    Route::post('/delivery/register', 'Staff/DeliveryController@make')->name('delivery.register');

    Route::get('/delivery/login', 'Staff/DeliveryController@login')->name('delivery.login');
    Route::post('/delivery/login', 'Staff/DeliveryController@signin')->name('delivery.signin');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/account/update/{user}', 'Client/UserController@update')->name('user.update');
    Route::patch('/account/update/{user}', 'Client/UserController@renew')->name('user.renew');

    Route::post('/logout', 'Client/UserController@logout')->name('user.logout');
    Route::delete('/account/delete/{user}', 'Client/UserController@delete')->name('user.delete');

    Route::get('/order', 'Client/OrderController@create')->name('order.create');
    Route::post('/order', 'Client/OrderController@make')->name('order.make');

    Route::get('/order/list', 'Client/OrderController@list')->name('order.list');

    Route::post('/distirbute/{order}', 'Client/OrderController@distirbute')->name('order.distirbute');

    Route::delete('/order/delete/{order}', 'Client/OrderController@delete')->name('order.delete');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/post/create', 'Client/PostController@create')->name('post.create');
    Route::post('/post/create', 'Client/PostConctroller@make')->name('post.make');

    Route::get('/post/update/{post}', 'Client/PostController@update')->name('post.update');
    Route::patch('/post/update/{post}', 'Client/PostController@renew')->name('post.renew');

    Route::delete('/post/delete/{post}', 'Client/PostController@delete')->name('post.delete');

    // Routes to make products
});

Route::group(['middleware' => 'staff'], function () {
    Route::get('/kitchen/table', 'Staff/KitchenController@table')->name('kitchen.table');
    

    Route::get('/hall/table', 'Staff/HallController@table')->name('hall.table');

    Route::get('/pickup/table', 'PickupController@table')->name('pickup.table');

    Route::get('/delivery/table', 'Staff/DeliveryController@table')->name('delivery.table');
    Route::post('/delivery/deliver/{order}', 'Staff/DeliveryController@deliver')->name('devliery.deliver');

    Route::get('/delivery/list', 'Staff/DeliveryController@list')->name('delivery.list');
});



/// ================================================================================

// Client routes' group
Route::group(['namespace' => 'Client'], function() {

    // Main controller route to show site
    Route::get('/', 'MainController@index')->name('main.index');

    Route::get('/xxx', 'MainController@admin');

    // Order controller routes
    Route::get('/order', 'OrderController@create')->name('order.create');
    Route::post('/order', 'OrderController@make')->name('order.make');
    Route::post('/order/close/{order}', 'MainController@close')->name('order.close');

    // 
    Route::get('/hall', 'MainController@table')->name('main.table');
});

// ===============================================

// Staff routes' group
Route::group(['namespace' => 'Staff'], function() {

    // Kitchen controller routes
    Route::get('/kitchen', 'KitchenController@index')->name('kitchen.index');

    Route::post('/distribution/{order}', 'DistributionController@distribute')->name('distribution.distribute');

    Route::get('/delivery/list', 'DeliveryController@list')->name('delivery.list');
    Route::post('/delivery/deliver/{order}', 'DeliveryController@deliver')->name('delivery.deliver');
    Route::get('/delivery/orders', 'DeliveryController@orders')->name('delivery.orders');

    Route::get('/pickup/list', 'PickupController@list')->name('pickup.list');

    Route::get('/hall/list', 'HallController@list')->name('hall.list');

    
});



// Заказать

// Создаем ордер
// - Товары (многое ко многим);
// - Имя 
// - Адрес



// Бизнес
// Вход для администраторов
// Принятие заказов (клиент)
// CRUD товаров/услуг (админ)
// Статистика по товарам (админ)
// Статьи (админка)

// Клинет
// Купить (Внесение информации и отправка в базу) + рекомендации + Корзина
// Читать статьи + Теги
// Связаться с нами

// Админ