<?php

namespace App\Policies;

use App\Models\Partylist;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PartylistPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('partylist_access');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Partylist $partylist): bool
    {
        return $user->hasPermission('partylist_show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('partylist_create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Partylist $partylist): bool
    {
        return $user->hasPermission('partylist_edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Partylist $partylist): bool
    {
        return $user->hasPermission('partylist_delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Partylist $partylist): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Partylist $partylist): bool
    {
        //
    }
}
