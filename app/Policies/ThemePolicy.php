<?php

namespace App\Policies;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ThemePolicy extends ServiceForPolicies
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
        else{
            return Response::denyAsNotFound('Alas. Sorry');
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
        else{
            return Response::denyAsNotFound('Alas. Sorry');
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Theme $theme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Theme $theme)
    {

        if (!$user) {
            return false;
        }

        $canView = $this->canView($user);
        $bothSameTeam = $user->team_id === $theme->team_id;
        $canView = $canView && $bothSameTeam;

        if ($canView) {
            return true;
        }
        else{
            return Response::denyAsNotFound('Alas. Sorry');
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
     * @param \App\Models\Theme $theme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Theme $theme)
    {
        if (!$user) {
            return false;
        }

        $canUpdate = $this->canUpdate($user);
        $bothSameTeam = $user->team_id === $theme->team_id;
        $canUpdate = $canUpdate && $bothSameTeam;

        if ($canUpdate) {
            return true;
        }
        else{
            return Response::denyAsNotFound('Alas. Sorry');
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Theme $theme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Theme $theme)
    {
        if (!$user) {
            return false;
        }

        $canDelete = $this->canDelete($user);
        $bothSameTeam = $user->team_id === $theme->team_id;
        $canDelete = $canDelete && $bothSameTeam;

        if ($canDelete) {
            return true;
        }
        else{
            return Response::denyAsNotFound('Alas. Sorry');
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Theme $theme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Theme $theme)
    {
        $canRestore = $this->canRestore($user);
        $bothSameTeam = $user->team_id === $theme->team_id;
        $canRestore = $canRestore && $bothSameTeam;

        if ($canRestore) {
            return true;
        }
        else{
            return Response::denyAsNotFound('Alas. Sorry');
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Theme $theme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Theme $theme)
    {
        $canForceDelete = $this->canForceDelete($user);
        $bothSameTeam = $user->team_id === $theme->team_id;
        $canForceDelete = $canForceDelete && $bothSameTeam;

        if ($canForceDelete) {
            return true;
        }
        else{
            return Response::denyAsNotFound('Alas. Sorry');
        }
    }
}
