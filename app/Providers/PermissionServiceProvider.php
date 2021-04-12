<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Iterate through permission collection
        // Pass objects to hasPermissionTo, where the name is extracted & compared and returns true/false based on if match is found.
        // Gate recieve parameters passed from auth blade directives (@can), here we can pass in a permission name such as @can 'create assignments'
        Permission::get()->map(function ($permission) {
            Gate::define($permission->permission_name, function ($user) use ($permission) {
                return $user->hasPermissionTo($permission);
            });
        });
    }
}
