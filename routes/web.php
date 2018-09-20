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

    Route::get('preferences', [
        'uses' => 'UserController@showPreferences',
        'as' => 'preferences'
    ]);

    Route::put('preferences', [
        'uses' => 'UserController@updatePreferences',
        'as' => 'preferences.update'
    ]);

});

Route::group([
    'middleware' => ['auth', 'role:admin'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function() {
    Route::get('/', [
        'uses' => 'Admin\AdminController@index',
        'as' => 'dashboard'
    ]);

    Route::get('users', [
        'uses' => 'Admin\AdminController@getUsers',
        'as' => 'users.index'
    ]);
    Route::get('users/data', [
        'uses' => 'Admin\AdminController@usersData',
        'as' => 'users.data'
    ]);
    Route::get('users/show/{id}', [
        'uses' => 'Admin\AdminController@showUser',
        'as' => 'users.show'
    ]);

    Route::get('logs', [
        'uses' => 'Admin\AdminController@getLogs',
        'as' => 'logs.index'
    ]);
    Route::get('logs/data', [
        'uses' => 'Admin\AdminController@logsData',
        'as' => 'logs.data'
    ]);
    Route::get('logs/show/{id}', [
        'uses' => 'Admin\AdminController@showLog',
        'as' => 'logs.show'
    ]);
    Route::put('logs/update/{id}', [
        'uses' => 'Admin\AdminController@updateLog',
        'as' => 'logs.update'
    ]);

    Route::get('configs', [
        'uses' => 'Admin\AdminController@showConfigs',
        'as' => 'configs.show'
    ]);
    Route::put('configs', [
        'uses' => 'Admin\AdminController@updateConfigs',
        'as' => 'configs.update'
    ]);

});
