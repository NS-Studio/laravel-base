<?php

namespace App\Providers;

use App\User;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Only admin and company users are allowed to access full dashboard
        Gate::define( 'access-dashboard', function ( User $user ) {

            return $user->isAdmin() || $user->isUser();

        } );

        // Only admin users can access admin panel of course
        Gate::define( 'access-admin', function ( User $user ) {

            return $user->isAdmin();

        } );
    }
}
