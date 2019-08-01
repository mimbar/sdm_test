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
});
