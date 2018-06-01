<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 5/22/18
 * Time: 11:02 PM
 */

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @param $view View
     *
     * @return void
     */
    public function boot()
    {
        View::composer( 'layouts.dashboard', function ( $view ) {

            return $view->with( [ 'user' => auth()->user() ] );
        } );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}