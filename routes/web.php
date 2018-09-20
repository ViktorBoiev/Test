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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');



Route::middleware(['auth'])->group(function() {
    Route::get('lottery', [
        'uses' => 'HomeController@lottery',
        'as' => 'lottery'
    ]);

    Route::post('lottery/prize', [
        'uses' => 'HomeController@prize',
        'as' => 'prize.generate',
    ]);

    Route::post('lottery/prize/accept', [
        'uses' => 'HomeController@acceptPrize',
        'as' => 'prize.accept',
    ]);
    Route::post('lottery/prize/decline', [
        'uses' => 'HomeController@declinePrize',
        'as' => 'prize.decline',
    ]);
    Route::post('lottery/prize/convert', [
        'uses' => 'HomeController@convertPrize',
        'as' => 'prize.convert',
    ]);
});
