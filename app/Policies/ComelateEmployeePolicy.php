<?php

namespace App\Policies;

use App\Models\ComelateEmployee;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ComelateEmployeePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Hanya SuperAdmin dan AdminHR yang bisa melihat semua model
        return $user->isSuperAdmin() || $user->isAdminHr() || $user->isSecurity();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ComelateEmployee $comelateEmployee): bool
    {
        // Hanya SuperAdmin dan AdminHR yang bisa melihat model tertentu
        return $user->isSuperAdmin() || $user->isAdminHr() || $user->isSecurity();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya SuperAdmin dan AdminHR yang bisa membuat model
        return $user->isSuperAdmin() || $user->isAdminHr() || $user->isSecurity();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ComelateEmployee $comelateEmployee): bool
    {
        // Hanya SuperAdmin dan AdminHR yang bisa mengupdate model
        return $user->isSuperAdmin() || $user->isAdminHr() || $user->isSecurity();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ComelateEmployee $comelateEmployee): bool
    {
        // Hanya SuperAdmin yang bisa menghapus model, AdminHR tidak bisa
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ComelateEmployee $comelateEmployee): bool
    {
        // Hanya SuperAdmin dan AdminHR yang bisa merestore model
        return $user->isSuperAdmin() || $user->isAdminHr() || $user->isSecurity();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ComelateEmployee $comelateEmployee): bool
    {
        // Hanya SuperAdmin yang bisa menghapus model secara permanen
        return $user->isSuperAdmin();
    }
}
