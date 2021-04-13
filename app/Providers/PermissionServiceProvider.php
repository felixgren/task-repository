<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        // Check if permissions table exists, boot is ran on every artisan command which results in error when migrations have not been ran.
        if (Schema::hasTable('permissions')) {
            // Iterate through permission collection
            // Pass objects to hasPermissionTo, where the name is extracted & compared and returns true/false based on if match is found.
            // Gate recieve parameters passed from auth blade directives (@can), here we can pass in a permission name such as @can 'create assignments'
            Permission::get()->map(function ($permission) {
                Gate::define($permission->permission_name, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });


            Blade::if('role', function ($role) {
                // https://github.com/barryvdh/laravel-ide-helper/issues/755
                // https://github.com/bmewburn/vscode-intelephense/issues/1051
                // auth()->user() not working here..
                return auth()->check() && request()->user()->hasRole($role);
            });
        }
    }
}
