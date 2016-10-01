<?php

namespace App\Policies;

use App\User;
use App\Loan;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Student  $student
     * @return bool
     */
    public function destroy(User $user, Loan $loan)
    {
        return true;
    }
}

