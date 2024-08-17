<?php

namespace App\Policies;

use App\Models\MeteranAir;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MeteranAirPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdminUtility(); // Only AdminUtility can access
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MeteranAir $meteranAir): bool
    {
        return $user->isAdminUtility(); // Only AdminUtility can access
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdminUtility(); // Only AdminUtility can access
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MeteranAir $meteranAir): bool
    {
        return $user->isAdminUtility(); // Only AdminUtility can access
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MeteranAir $meteranAir): bool
    {
        return $user->isSuperAdmin(); // Only SuperAdmin can delete
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MeteranAir $meteranAir): bool
    {
        return $user->isAdminUtility(); // Only AdminUtility can access
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MeteranAir $meteranAir): bool
    {
        return $user->isSuperAdmin(); // Only SuperAdmin can permanently delete
    }
}
