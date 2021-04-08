<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasPermissionsTrait
{
    // Check if user has role, supports checking multiple roles. [input array]
    // Compare input to roles in 'name' column in roles table
    // --When checking multiple roles, any match will result true return--
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        return $this->hasPermission($permission);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles'); // user has many roles
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions'); // user has many perms
    }
}
