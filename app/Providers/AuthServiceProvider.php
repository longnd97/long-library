<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::define('user-crud', function () {
            $userLogin = Auth::user();
            if ($userLogin->checkRole('Admin')) {
                return true;
            }
            return false;
        });
        Gate::define('book-crud', function () {
            $userLogin = Auth::user();
            if ($userLogin->checkRole('Admin')) {
                return true;
            }
            return false;
        });
        Gate::define('category-crud', function () {
            $userLogin = Auth::user();
            if ($userLogin->checkRole('Admin')) {
                return true;
            }
            return false;
        });
        Gate::define('student-crud', function () {
            $userLogin = Auth::user();
            if ($userLogin->checkRole('Admin')) {
                return true;
            }
            return false;
        });
        Gate::define('borrow-crud', function () {
            $userLogin = Auth::user();
            if ($userLogin->checkRole('Admin') || $userLogin->checkRole('Librarian')){
                return true;
            }
            return false;
        });
    }
}
