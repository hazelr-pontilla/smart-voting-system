<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Voters;
use Illuminate\Auth\Access\Response;

class VotersPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('voter_access');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Voters $voters): bool
    {
        return $user->hasPermission('voter_show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('voter_create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Voters $voters): bool
    {
        return $user->hasPermission('voter_edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Voters $voters): bool
    {
        return $user->hasPermission('voter_delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Voters $voters): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Voters $voters): bool
    {
        //
    }
}
