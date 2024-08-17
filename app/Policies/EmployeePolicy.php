<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any employees.
     */
    public function viewAny(User $user)
    {
        return $user->isSuperAdmin() || $user->isAdminHr();
    }

    /**
     * Determine whether the user can view the employee.
     */
    public function view(User $user, Employee $employee)
    {
        return $user->isSuperAdmin() || $user->isAdminHr();
    }

    /**
     * Determine whether the user can create employees.
     */
    public function create(User $user)
    {
        return $user->isSuperAdmin() || $user->isAdminHr();
    }

    /**
     * Determine whether the user can update the employee.
     */
    public function update(User $user, Employee $employee)
    {
        return $user->isSuperAdmin() || $user->isAdminHr();
    }

    /**
     * Determine whether the user can delete the employee.
     */
    public function delete(User $user, Employee $employee)
    {
        return $user->isSuperAdmin() || $user->isAdminHr();
    }
}
