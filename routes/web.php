<?php

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

Route::get('/', function () {
    \App\User::bootUsers();
    \App\Menu::bootData();
    \App\Order::bootOrders();
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/orders', 'OrdersController@index');
Route::post('/orders', 'OrdersController@store');
Route::get('/view_report', 'OrdersController@show');
