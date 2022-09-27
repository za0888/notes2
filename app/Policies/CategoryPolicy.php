<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy extends ServiceForPolicies
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if (!$user) {
            return false;
        }

        if ($this->canBanUser($user)) {
            return true;
        }

    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if (!$user) {
            return false;
        }

        $canView = $this->canView($user);
        if ($canView) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Category $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Category $category)
    {
        if (!$user) {
            return false;
        }

        $canView = $this->canView($user);
        $bothSameTeam = $user->team_id === $category->team_id;
        $canView = $canView && $bothSameTeam;

        if ($canView) {
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

        if (!$user) {
            return false;
        }

        $canCreate = $this->canCreate($user);

        return $canCreate
            ? Response::allow()
            : Response::denyAsNotFound('You cannot create a Note. POLICY SAYS');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Category $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Category $category)
    {
        if (!$user) {
            return false;
        }

        $canUpdate = $this->canUpdate($user);
        $bothSameTeam = $user->team_id === $category->team_id;
        $canUpdate = $canUpdate && $bothSameTeam;

        if ($canUpdate) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Category $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Category $category)
    {
        if (!$user) {
            return false;
        }

        $canDelete = $this->canDelete($user);
        $bothSameTeam = $user->team_id === $category->team_id;
        $canDelete = $canDelete && $bothSameTeam;

        if ($canDelete) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Category $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Category $category)
    {
        $canRestore = $this->canRestore($user);
        $bothSameTeam = $user->team_id === $category->team_id;
        $canRestore = $canRestore && $bothSameTeam;

        if ($canRestore) {
            return true;
        }

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Category $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Category $category)
    {
        $canForceDelete = $this->canForceDelete($user);
        $bothSameTeam = $user->team_id === $category->team_id;
        $canForceDelete = $canForceDelete && $bothSameTeam;

        if ($canForceDelete) {
            return true;
        }
    }


}
