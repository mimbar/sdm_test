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
        Route::get('/', 'KitchenController@usersIndex')->name('read')->middleware('permission:users.*');
        Route::post('/', 'KitchenController@usersCreate')->name('create')->middleware('permission:users.create');
        Route::patch('/', 'KitchenController@usersUpdate')->name('update')->middleware('permission:users.update');
        Route::delete('/', 'KitchenController@usersDelete')->name('delete')->middleware('permission:users.delete');
        Route::post('check/username', 'KitchenController@usersCheckUsername')->name('check.username')->middleware('permission:users.*');
        Route::post('check/email', 'KitchenController@usersCheckEmail')->name('check.email')->middleware('permission:users.*');
        Route::post('reset', 'KitchenController@usersReset')->name('reset')->middleware('permission:users.update');
    });

    Route::group([
        'prefix' => 'roles',
        'as' => 'roles.',
    ], function () {
        Route::get('/', 'KitchenController@rolesIndex')->name('read')->middleware('permission:roles.*');
        Route::post('/', 'KitchenController@rolesCreate')->name('create')->middleware('permission:roles.create');
        Route::patch('/', 'KitchenController@rolesUpdate')->name('update')->middleware('permission:roles.update');
        Route::delete('/', 'KitchenController@rolesDelete')->name('delete')->middleware('permission:roles.delete');
    });

    Route::group([
        'prefix' => 'permissions',
        'as' => 'permissions.',
    ], function () {
        Route::get('/', 'KitchenController@permissionsIndex')->name('read')->middleware('permission:permissions.*');
        Route::post('/', 'KitchenController@permissionsCreate')->name('create')->middleware('permission:permissions.create');
        Route::patch('/', 'KitchenController@permissionsUpdate')->name('update')->middleware('permission:permissions.update');
        Route::delete('/', 'KitchenController@permissionsDelete')->name('delete')->middleware('permission:permissions.delete');
    });

    Route::group([
        'prefix' => 'assign',
        'as' => 'assign.',
    ], function () {
        Route::get('/', 'KitchenController@assignIndex')->name('read')->middleware('permission:assign.update');
        Route::post('setroles', 'KitchenController@assignSetRoles')->name('setroles')->middleware('permission:assign.update');
        Route::post('setpermissions', 'KitchenController@assignSetPermissions')->name('setpermissions')->middleware('permission:assign.update');
    });
});
