<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('solutionmed' , function(User $user) {
            return $user->id === 1
                ? Response::allow()
                : Response::deny();
        });

        Gate::define('sphere-client', function (User $user) {
            return $user->tokenCan('sphere-client') && !$user->tokenCan('*')
                        ? Response::allow()
                        : Response::deny();
        });
    }
}