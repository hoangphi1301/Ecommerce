<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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

        Gate::define('view-user', function ($user, $post) {
                foreach($user->userpermit as $permit){
                if($permit->permit == 'view-user'){

                    return true;
                }
            }

                return false;
        });

        Gate::define('create-user', function ($user, $post) {

            foreach($user->userpermit as $permit){
                if($permit->permit == 'create-user'){
                    return true;
                }
            }

                return false;
        });

        Gate::define('update-user', function ($user, $post) {
                foreach($user->userpermit as $permit){
                if($permit->permit == 'update-user'){
                    return true;
                }
            }

                return false;
        });

        Gate::define('delete-user', function ($user, $post) {
                 foreach($user->userpermit as $permit){
                if($permit->permit == 'delete-user'){
                    return true;
                }
            }

                return false;
        });

    }
}
