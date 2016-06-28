<?php

namespace App\Policies;

use App\User;
use App\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Student  $student
     * @return bool
     */
    public function destroy(User $user, Student $student)
    {
        return $user->id === $student->user_id;
    }
}

