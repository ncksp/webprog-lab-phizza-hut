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

Route::resource('pizza', 'PizzaController');

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::resource('cart', 'CartController')->middleware('authorization.simple:user');

    Route::group(['middleware' => ['authorization.simple:admin']], function () {
        Route::get('users', 'HomeController@users')->name('users.view');
        Route::get('/transaction', 'TransactionController@all')->name('transaction.all');
    });

    Route::get('history/{id}', 'TransactionController@historyDetail')->middleware('authorization.simple:user,admin')->name('history.detail');

    Route::group(['prefix' => 'transaction', 'middleware' => ['authorization.simple:user']], function () {
        Route::get('history', 'TransactionController@history')->name('history.all');
        Route::post('store', 'TransactionController@store')->name('transaction.store');
    });
});
