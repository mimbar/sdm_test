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
    'prefix' => 'dt',
    'as' => 'dt.',
    'middleware' => 'hades'
], function () {

    Route::group([
        'prefix' => 'users',
        'as' => 'users.',
    ], function () {
        Route::post('all', 'KitchenController@allUsers')->name('all');
    });


    Route::group([
        'prefix' => 'roles',
        'as' => 'roles.',
    ], function () {
        Route::post('all', 'KitchenController@allRoles')->name('all');
    });

    Route::group([
        'prefix' => 'permissions',
        'as' => 'permissions.',
    ], function () {
        Route::post('all', 'KitchenController@allPermissions')->name('all');
    });

    Route::group([
        'prefix' => 'unitkerja',
        'as' => 'unitkerja.',
    ], function () {
        Route::post('all', 'KitchenController@allUnitKerja')->name('all');
    });

    Route::group([
        'prefix' => 'grp',
        'as' => 'grp.',
    ], function () {
        Route::post('all', 'KitchenController@allGrp')->name('all');
    });

    Route::group([
        'prefix' => 'statuspegawai',
        'as' => 'statuspegawai.',
    ], function () {
        Route::post('all', 'KitchenController@allStatusPegawai')->name('all');
    });

    Route::group([
        'prefix' => 'pegawai',
        'as' => 'pegawai.',
    ], function () {
        Route::post('all', 'KitchenController@allPegawai')->name('all');
    });

    Route::group([
        'prefix' => 'dosen',
        'as' => 'dosen.',
    ], function () {
        Route::post('all', 'KitchenController@allDosen')->name('all');
    });
});
