<?php

namespace App\Providers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes(
            function ($router){
                $router->forAccessTokens();
            }
        );

        Gate::define('owns-this-todo', function (User $user, Todo $todo){
            return $user->id ===$todo->user_id;
        });
    }
}
