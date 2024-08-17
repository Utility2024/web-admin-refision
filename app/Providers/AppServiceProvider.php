<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Filament\Panel;

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
        Gate::define('access-panel', function (User $user, Panel $panel) {
            return $user->canAccessPanel($panel);
        });

        Gate::before(function (User $user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }
}
