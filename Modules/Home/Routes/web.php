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
    'prefix' => 'home',
    'as' => 'home.',
    'middleware' => 'hades'
], function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('acl', 'HomeController@acl')->name('acl')->middleware("permission:acl.*");
    Route::get('users', 'HomeController@users')->name('users')->middleware("permission:users.*");
    Route::get('profile', 'HomeController@profile')->name('profile')->middleware("permission:profile.*");
});
