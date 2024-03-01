<?php

namespace App\Policies;

use App\Models\Hospital_Affiliation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HospitalAffiliationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Hospital_Affiliation $hospitalAffiliation): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Hospital_Affiliation $hospitalAffiliation): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Hospital_Affiliation $hospitalAffiliation): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Hospital_Affiliation $hospitalAffiliation): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Hospital_Affiliation $hospitalAffiliation): bool
    {
        //
    }
}
