<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, User $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return false;
    }

    // user can update model
    public function update(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    // user can delete model
    public function delete(User $user, User $model)
    {
        return false;
    }

    // user can restore model
    public function restore(User $user, User $model)
    {
        return false;
    }

    // user can delete model permanently
    public function forceDelete(User $user, User $model)
    {
        return false;
    }
}
