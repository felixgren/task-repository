<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Arr;

trait HasPermissionsTrait
{
    public function givePermissionTo(...$permissions)
    {
        // get permission model and append to it thru saveMany
        $permissions = $this->getPermissions(Arr::flatten($permissions));
        // dd($permissions);

        // $this->permissions()->saveMany($permissions);
        $this->permissions()->syncWithoutDetaching($permissions);
    }

    public function removePermissionTo(...$permissions)
    {
        $permissions = $this->getPermissions(Arr::flatten($permissions));

        $this->permissions()->detach($permissions);
    }

    public function getPermissions(array $permissions)
    {
        return Permission::whereIn('permission_name', $permissions)->get();
    }

    // We pass in a string, we avoid exposing the method through protected hasPermission.
    public function hasPermissionTo($permission): bool
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermissionThroughUser($permission);
    }

    protected function hasPermissionThroughUser($permission): bool
    {
        return $this->permissions->where('permission_name', $permission->permission_name)->count();
    }

    protected function hasPermissionThroughRole($permission): bool
    {
        // Permissions belongs to roles
        // We check input permission for which roles it is part of.

        // From permission, check which roles have permission, if user belongs to role, assume they have permission.
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
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
