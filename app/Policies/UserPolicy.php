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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        $userCanView = $this->isAdmin($user) || $this->isSuperAdmin($user);

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
    public function update(User $user, User $model)
    {
        $userCanUpdate = $this->isAdmin($user) || $this->isSuperAdmin($user);
        $userCanUpdate = $userCanUpdate && $this->canUpdate($user);

        if ($userCanUpdate) {
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
    public function delete(User $user, User $model)
    {
        $userCanDelete = $this->isAdmin($user) || $this->isSuperAdmin($user);
        $userCanDelete = $userCanDelete && $this->canDelete($user);

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
        $userCanRestore = $this->isAdmin($user) || $this->isSuperAdmin($user);
        $userCanRestore = $userCanRestore && $this->canRestore($user);

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
        $userCanForceDelete = $this->isAdmin($user) || $this->canBanUser($user);
        $userCanForceDelete = $userCanForceDelete && $this->canForceDelete($user);

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
