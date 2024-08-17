<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Hanya SuperAdmin yang bisa melihat semua model
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Hanya SuperAdmin yang bisa melihat model tertentu
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya SuperAdmin yang bisa membuat model
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // Hanya SuperAdmin yang bisa mengupdate model
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Hanya SuperAdmin yang bisa menghapus model
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        // Hanya SuperAdmin yang bisa merestore model
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        // Hanya SuperAdmin yang bisa menghapus model secara permanen
        return $user->isSuperAdmin();
    }
}
