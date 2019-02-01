<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use App\User;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        // Only admin and company users are allowed to access full dashboard
        Gate::define('access-dashboard', function (User $user) {

            return $user->hasAnyRole('admin', 'user', 'developer');
        });

        // Only admin users can access admin panel of course
        Gate::define('access-admin', function (User $user) {

            return $user->hasAnyRole('admin', 'developer');
        });
    }
}
