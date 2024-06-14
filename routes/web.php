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

use App\Models\Product;

Route::get('/', 'MainController@index')->name('main.index');

Route::get('/order', 'OrderController@createOrder')->name('order.create');
Route::post('/order', 'OrderController@makeOrder')->name('order.name');

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