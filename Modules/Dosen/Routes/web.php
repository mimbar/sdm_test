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

Route::prefix('dosen')->as('dosen.')->group(function() {
    Route::resource('dosen', 'DosenController');
    Route::post('import', 'DosenController@import')->name('import');
    Route::get('export/{jenis}', 'DosenController@export')->name('export');
});
