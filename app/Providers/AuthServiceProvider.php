<?php

namespace App\Providers;

use App\Models\Assignment;
use App\Policies\AssignmentPolicy;
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
        Assignment::class => AssignmentPolicy::class,
        User::class => AssignmentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Permission::get($permission){
        //     Gate::define('create-assignment', function ($user) use ($permission) {
        //         return $user->checkPermission('create-assignment');
        //     });

        // })
    }
}
