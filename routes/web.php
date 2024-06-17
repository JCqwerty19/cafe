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

// Client routes' group
Route::group(['namespace' => 'Client'], function() {

    // Main controller route to show site
    Route::get('/', 'MainController@index')->name('main.index');

    // Order controller routes
    Route::get('/order', 'OrderController@create')->name('order.create');
    Route::post('/order', 'OrderController@make')->name('order.make');

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