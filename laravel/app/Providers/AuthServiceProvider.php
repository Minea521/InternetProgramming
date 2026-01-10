<?php

namespace App\Providers;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        // Add other models here as needed
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        
        // Keep your existing Gate definitions
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        Gate::define('users.manage', fn($user) => $user->hasPermission('users.manage'));
        Gate::define('products.create', fn($user) => $user->hasPermission('products.create'));
        Gate::define('products.update', fn($user) => $user->hasPermission('products.update'));
        Gate::define('products.delete', fn($user) => $user->hasPermission('products.delete'));
        Gate::define('categories.create', fn($user) => $user->hasPermission('category.create'));
        Gate::define('categories.update', fn($user) => $user->hasPermission('category.update'));
        Gate::define('categories.delete', fn($user) => $user->hasPermission('category.delete'));
        Gate::define('categories.view', fn($user) => $user->hasPermission('category.view'));
        Gate::define('products.view', fn($user) => $user->hasPermission('products.view'));
    }
}