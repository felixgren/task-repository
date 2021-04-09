<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
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
        // map thru all permissions

        //fetch all 
        // return true;
        Permission::get()->map(function ($permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return  $user->hasPermissionTo($permission);
            });
        });
    }
}
