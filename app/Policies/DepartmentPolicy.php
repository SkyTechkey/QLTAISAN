<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Department $department)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Department $department)
    {
        //
    }

    public function delete(User $user, Department $department)
    {
        //
    }

   
    public function restore(User $user, Department $department)
    {
        //
    }

    public function forceDelete(User $user, Department $department)
    {
        //
    }
}
