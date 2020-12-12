<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes(['verify' => true]);
Route::get('/', 'HomeController@index')->name('home');
Route::get('/pizza/{id}', 'PizzaController@detail')->name('pizza.detail');

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::get('history', 'HomeController@index')->name('history.all');
    Route::get('transaction', 'HomeController@index')->name('transaction.all');
    Route::resource('cart', 'CartController');
    Route::resource('pizza', 'PizzaController');
    Route::get('users', 'HomeController@index')->name('users.view');
});
