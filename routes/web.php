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

Auth::routes();

Route::get( '/', function () {

    return view( 'layouts.dashboard' );
} )->name( 'home' )->middleware( [ 'web', 'auth:web' ] );

Route::get( '403', function () {

    abort( 403, 'You are not allowed to use this action.' );
} );

Route::group( [ 'prefix' => 'admin', 'middleware' => [ 'auth', 'admin' ], 'namespace' => 'Admin' ], function () {

    Route::get( 'panel', 'AdminController@panel' )->name( 'admin.panel' );

    Route::get( 'users', 'AdminController@listUsers' )->name( 'admin.users.list' );

    Route::post( 'users', 'AdminController@store' )->name( 'admin.users.store' );

    Route::put( 'users/{user}', 'AdminController@update' )->name( 'admin.users.update' );

    Route::delete( 'users/{user}', 'AdminController@delete' )->name( 'admin.users.delete' );
} );
