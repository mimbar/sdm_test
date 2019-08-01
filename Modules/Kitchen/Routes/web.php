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

Route::prefix('kitchen')->group(function() {
    Route::get('/', 'KitchenController@index');
});

Route::group([
    'prefix' => 'kitchen',
    'as' => 'kitchen.',
    'middleware' => 'hades'
], function () {
    Route::group([
        'prefix' => 'users',
        'as' => 'users.',
    ], function () {
        Route::get('/', 'KitchenController@usersIndex')->name('read')->middleware('permission:aclusers.*');
        Route::post('/', 'KitchenController@usersCreate')->name('create')->middleware('permission:aclusers.create');
        Route::patch('/', 'KitchenController@usersUpdate')->name('update')->middleware('permission:aclusers.update');
        Route::delete('/', 'KitchenController@usersDelete')->name('delete')->middleware('permission:aclusers.delete');
    });

    Route::group([
        'prefix' => 'roles',
        'as' => 'roles.',
    ], function () {
        Route::get('/', 'KitchenController@rolesIndex')->name('read');
        Route::post('/', 'KitchenController@rolesCreate')->name('create');
        Route::patch('/', 'KitchenController@rolesUpdate')->name('update');
        Route::delete('/', 'KitchenController@rolesDelete')->name('delete');
    });

    Route::group([
        'prefix' => 'permissions',
        'as' => 'permissions.',
    ], function () {
        Route::get('/', 'KitchenController@permissionsIndex')->name('read');
        Route::post('/', 'KitchenController@permissionsCreate')->name('create');
        Route::patch('/', 'KitchenController@permissionsUpdate')->name('update');
        Route::delete('/', 'KitchenController@permissionsDelete')->name('delete');
    });

    Route::group([
        'prefix' => 'assign',
        'as' => 'assign.',
    ], function () {
        Route::get('/', 'KitchenController@assignIndex')->name('read');
        Route::post('setroles', 'KitchenController@assignSetRoles')->name('setroles');
        Route::post('setpermissions', 'KitchenController@assignSetPermissions')->name('setpermissions');
    });
});
