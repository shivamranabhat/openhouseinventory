<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Register policies here using the `Gate` facade

        Gate::define('action-approve', function (User $user) {
            return $user->can_approve === 'Yes'; // or `$user->can_approve == true;` if boolean
        });
        Gate::define('action-decline', function (User $user) {
            return $user->can_decline === 'Yes'; // or `$user->can_decline == true;` if boolean
        });
        Gate::define('action-create', function (User $user) {
            return $user->can_create === 'Yes'; // or `$user->can_create == true;` if boolean
        });

        Gate::define('action-edit', function (User $user) {
            return $user->can_edit === 'Yes'; // or `$user->can_edit == true;` if boolean
        });
        Gate::define('action-delete', function (User $user) {
            return $user->can_delete === 'Yes'; // or `$user->can_delete == true;` if boolean
        });
        Gate::define('super-admin', function (User $user) {
            return $user->role === 'Super Admin'; // or `$user->role == Super Admin;` if boolean
        });
    }
}
