<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Assignment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        return null;
    }

    public function create(User $user, Assignment $assignment)
    {
        if ($user->can('create assignments')) {
            return true;
        }
    }

    public function edit(User $user, Assignment $assignment)
    {
        return $user->id === $assignment->user_id || $user->can('edit assignments');
    }

    public function update(User $user, Assignment $assignment)
    {
        return $user->id === $assignment->user_id || $user->can('edit assignments');
    }

    public function delete(User $user, Assignment $assignment)
    {
        return $user->id === $assignment->user_id || $user->can('delete assignments');
    }
}
