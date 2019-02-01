<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function () {

    Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function () {

        Route::get('panel', 'AdminController@panel')->name('admin.panel');

        Route::get('users', 'AdminController@index')->name('admin.users.list');

        Route::post('users', 'AdminController@store')->name('admin.users.store');

        Route::put('users/{user}', 'AdminController@update')->name('admin.users.update');

        Route::delete('users/{user}', 'AdminController@delete')->name('admin.users.delete');
    });
});
