<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasPermissionsTrait
{
    // We pass in a string, we avoid exposing the method through protected hasPermission.
    public function hasPermissionTo($permission): bool
    {
        // here i will check if perm is through role too 

        return $this->hasPermission($permission);
    }

    protected function hasPermission($permission): bool
    {
        return $this->permissions->where('permission_name', $permission->permission_name)->count();
    }

    // Check if user has role, supports checking multiple roles. [input array]
    // Compare input to roles in 'role_name' column in roles table
    // --When checking multiple roles, any match will result true return--
    public function hasRole(...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('role_name', $role)) {
                return true;
            }
        }
        return false;
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
