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
    Route::group(['prefix' => 'transaction'], function () {
        Route::get('/', 'TransactionController@all')->name('transaction.all');
        Route::get('history', 'TransactionController@history')->name('history.all');
        Route::get('history/{id}', 'TransactionController@historyDetail')->name('history.detail');
        Route::post('store', 'TransactionController@store')->name('transaction.store');
    });
    Route::resource('cart', 'CartController');
    Route::resource('pizza', 'PizzaController');
    Route::get('users', 'HomeController@index')->name('users.view');
});
