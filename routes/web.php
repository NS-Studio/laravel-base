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

Route::get('/', function () {

    if (auth()->check()) {

        return redirect()->route('admin.users.list');
    }

    return view('layouts.dashboard');
})->name('home')->middleware(['web', 'auth:web']);

Route::get('/{vue_capture?}', function () {
    return view('layouts.dashboard');
})->where('vue_capture', '[\/\w\.-]*');

Route::get('403', function () {

    abort(403, 'You are not allowed to use this action.');
});


