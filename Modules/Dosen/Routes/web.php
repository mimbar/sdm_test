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
    'prefix' => 'dosen',
    'as' => 'dosen.',
    'middleware' => 'hades'
], function () {
    Route::group([
        'prefix' => 'dosen',
        'as' => 'dosen.',
    ], function () {
        Route::get('/', 'DosenController@index')->name('read');

        Route::post('/', 'DosenController@create')->name('create');
        Route::patch('/', 'DosenController@update')->name('update');


        Route::get('{id}/depan', 'DosenController@printDepan')->name('print.depan');
        Route::get('{id}/belakang', 'DosenController@printBelakang')->name('print.belakang');

        Route::post('upload', 'DosenController@upload')->name('upload');

        Route::patch('kalkulasi', 'DosenController@kalkulasi')->name('kalkulasi');
    });
});
