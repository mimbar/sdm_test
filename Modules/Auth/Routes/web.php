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
    Route::post('login', 'AuthController@loginPost')->name('login');
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::get('adduser', function(){

    });

    Route::group([
        'prefix' => 'manager',
        'as' => 'manager.',
        'middleware' => 'login'
    ], function() {
        Route::get('/', 'AuthController@permission')->name('permission.read');
        Route::post('/permission', 'AuthController@storePermission')->name('permission.create');
        Route::patch('/permission', 'AuthController@updatePermission')->name('permission.update');

        Route::post('/roles', 'AuthController@storeRole')->name('role.create');
        Route::patch('/roles', 'AuthController@updateRole')->name('role.update');
        Route::post('/roles/assign', 'AuthController@assignRoleToPermission')->name('role.assign');


    });
});
