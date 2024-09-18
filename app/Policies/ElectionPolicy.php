<?php

namespace App\Policies;

use App\Models\Election;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ElectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('user_access');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Election $election): bool
    {
        return $user->hasPermission('user_show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('user_create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Election $election): bool
    {
        return $user->hasPermission('user_edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Election $election): bool
    {
        return $user->hasPermission('user_delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Election $election): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Election $election): bool
    {
        //
    }
}
