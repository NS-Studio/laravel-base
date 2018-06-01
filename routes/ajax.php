<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 3/3/18
 * Time: 9:13 PM
 */

Route::get( 'search', function ( \Illuminate\Http\Request $request ) {

    $query = $request->get( 'query' );

    /**
     * Example of search would go like this
     *
     * $results = \App\User::search( $query )->get()->values()->all();
     *
     * return response()->json(compact('results'));
     *
     * NOTE!!!! You must setup your searchable models with Laravel Scout before you can use this functionality
     * https://laravel.com/docs/5.6/scout
     */

    return response()->json( [ 'errors' => [ 'not_found' => 'Nothing is found, please update routes/ajax.php search route
    .' ] ], 404 );
} )->name( 'ajax.search' );