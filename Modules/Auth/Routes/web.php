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



Route::group([
    'prefix' => 'auth',
    'as' => 'auth.'
], function() {
    Route::get('/', function(){
        return redirect()->route('auth.login');
    });
    Route::get('login', 'AuthController@login')->name('view');
    Route::get('fresh', 'AuthController@fresh')->name('fresh');
    Route::get('locked', 'AuthController@locked')->name('locked');
    Route::post('fresh', 'AuthController@freshSetPassword')->name('freshset');
    Route::post('login', 'AuthController@loginPost')->name('login');
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::get('adduser', function(){

    });
});
