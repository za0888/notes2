<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\CheckPermisson;

class UserPolicy
{
    use HandlesAuthorization;
    use CheckPermisson;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if (!$user) {
            return  false;
        }
        if ($this->isSuperAdmin($user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, $id)
    {
        if (!$user) {
            return  false;
        }
//        by admins & himself
        $userCanView = $this->canControlUser($user) || $user->id === $id;

        if ($userCanView) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user,$id)
    {
        //  here the id is an id of the user to be edited
        if (!$user) {
            return  false;
        }

        $userCanUpdate=$this->canControlUser($user) ||$user->id === $id->id;
        $userCanUpdate = $this->canControlUser($user) ;


        if ($userCanUpdate) {
            return true;
        }
    }

//  here the id is an id of the user to be edited
    public function edit(User $user,$id)
    {
        if (!$user) {
            return  false;
        }
//        dd('============',$user->id , $id->id);
        $userCanEdit = $this->canControlUser($user) || $user->id === $id?->id;
//        $userCanUpdate = $this->canControlUser($user) || $user->id === $model->id;


        if ($userCanEdit) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user,$id)
    {
        if (!$user) {
        return  false;
    }
        $userCanDelete = $this->canControlUser($user);

        if ($userCanDelete) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        if (!$user) {
            return  false;
        }
        $userCanRestore = $this->canControlUser($user);

        if ($userCanRestore) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        if (!$user) {
            return  false;
        }
        $userCanForceDelete = $this->canControlUser($user);

        if ($userCanForceDelete) {
            return true;
        }
    }

    public function before(User $user, string $ability)
    {
        if (!$user) {
            return false;
        }

        if ($this->canBanUser($user)) {
            return true;
        }

    }


}
