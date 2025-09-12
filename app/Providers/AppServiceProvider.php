<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        // Registro da Política de Autorização
        Gate::policy(User::class, UserPolicy::class);

        Gate::define('access-admin-menu', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('access-new-menu', function (User $user) {
            return $user->role === 'new';
        });

        // Compartilhar com todas as views
        // View::composer('*', function ($view) {
        //     $usersPendingCount = User::where('role', 'new')->count();
        //     $view->with('usersPendingCount', $usersPendingCount);
        // });

        $usersPendingCount = User::where('role', 'new')->count();
        View::share('usersPendingCount', $usersPendingCount);
    }
}
