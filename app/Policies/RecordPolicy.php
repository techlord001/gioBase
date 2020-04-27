<?php

namespace App\Policies;

use App\Record;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function view(User $user, Record $record)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->role->role, [
            'Contributor',
            'Admin',
            'Master'
        ]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function update(User $user)
    {
        return in_array($user->role->role, [
            'Contributor',
            'Admin',
            'Master'
        ]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function delete(User $user)
    {
        return in_array($user->role->role, [
            'Admin',
            'Master'
        ]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function restore(User $user, Record $record)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Record  $record
     * @return mixed
     */
    public function forceDelete(User $user, Record $record)
    {
        //
    }
}
