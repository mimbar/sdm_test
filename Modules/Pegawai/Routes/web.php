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
    'prefix' => 'pegawai',
    'as' => 'pegawai.',
    'middleware' => 'hades'
], function () {
    Route::group([
        'prefix' => 'pegawai',
        'as' => 'pegawai.',
    ], function () {
        Route::get('/', 'PegawaiController@index')->name('read');
        Route::post('/', 'PegawaiController@create')->name('create');
        Route::patch('/', 'PegawaiController@update')->name('update');
    });
});
