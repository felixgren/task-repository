<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasPermissionsTrait
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles'); // user has many roles
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions'); // user has many perms
    }
}
