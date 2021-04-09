<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasPermissionsTrait
{
    public function hasPermissionTo($permission)
    {
        // string is passed to this
        // has permission throug role

        // return $this->hasPermission($permission)
        // return true;
        dd($this->hasPermission($permission));
    }

    protected function hasPermission($permission)
    {
        return $this->permissions;
        // return $this->permissions->where('name', $permission->name);
        // foreach ($permissions as $permission) {
        //     if ($this->permissions()->contains('name', $permission)) {
        //         return true;
        //     }
        // }
        // return false;
    }

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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles'); // user has many roles
    }

    public function hehe()
    {
        return "fuck my liiife";
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissisons'); // user has many perms

        // AAAAAAAAAAAAAAAAAAA IT WAS A FUCKING TYPO
    }
}
