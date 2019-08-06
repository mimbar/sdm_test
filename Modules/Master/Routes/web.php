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
    'prefix' => 'master',
    'as' => 'master.',
    'middleware' => 'hades'
], function () {
    Route::group([
        'prefix' => 'unitkerja',
        'as' => 'unitkerja.',
    ], function () {
        Route::get('/', 'MasterController@unitkerjaIndex')->name('read');
        Route::post('/', 'MasterController@unitkerjaCreate')->name('create');
        Route::patch('/', 'MasterController@unitkerjaUpdate')->name('update');
    });

    Route::group([
        'prefix' => 'grp',
        'as' => 'grp.',
    ], function () {
        Route::get('/', 'MasterController@grpIndex')->name('read');
        Route::post('/', 'MasterController@grpCreate')->name('create');
        Route::patch('/', 'MasterController@grpUpdate')->name('update');
    });

    Route::group([
        'prefix' => 'statuspegawai',
        'as' => 'statuspegawai.',
    ], function () {
        Route::get('/', 'MasterController@statuspegawaiIndex')->name('read');
        Route::post('/', 'MasterController@statuspegawaiCreate')->name('create');
        Route::patch('/', 'MasterController@statuspegawaiUpdate')->name('update');
    });
});
