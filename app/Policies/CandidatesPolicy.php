<?php

namespace App\Policies;

use App\Models\Candidates;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CandidatesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('candidate_access');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Candidates $candidates): bool
    {
        return $user->hasPermission('candidate_show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('candidate_create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Candidates $candidates): bool
    {
        return $user->hasPermission('candidate_edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Candidates $candidates): bool
    {
        return $user->hasPermission('candidate_delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Candidates $candidates): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Candidates $candidates): bool
    {
        //
    }
}
