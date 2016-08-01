<?php

namespace App\Policies;

use App\User;
use App\Resource;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Student  $student
     * @return bool
     */
    public function destroy(User $user, Resource $resource)
    {
        return true;
    }
}

