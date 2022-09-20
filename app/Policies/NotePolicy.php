<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\CheckPermisson;
use Illuminate\Auth\Access\Response;

class NotePolicy extends ServiceForPolicies
{
    use HandlesAuthorization;
    use CheckPermisson;

    /**
     * Perform pre-authorization checks.
     *
     * @param \App\Models\User $user
     * @param string $ability
     * @return void|bool
     */
    public function before(User $user, string $ability)
    {

        if ($this->canBanUser($user)) {
//            dd($user);
            return true;
        }

        if ($this->isAdmin($user)) {
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
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Note $note)
    {
        if (!$user) {
            return false;
        }

        $canView = $this->canView($user);
        $bothInTeam = $user->team_id === $note->team_id;
        $canView = $canView && $bothInTeam;

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
//        if ($canCreate) {
//            return true;
//        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Note $note)
    {

        $canUpdate = $this->canUpdate($user);
        $bothInTeam = $user->team_id === $note->team_id;
        $canUpdate = $canUpdate && $bothInTeam;

        if ($canUpdate) {
            return true;
        }

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Note $note)
    {

        $canDelete = $this->canDelete($user);
        $bothInTeam = $user->team_id === $note->team_id;
        $canDelete = $canDelete && $bothInTeam;

        if ($canDelete) {
            return true;
        }

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Note $note)
    {
//
        $canRestore = $this->canRestore($user);
        $bothInTeam = $user->team_id === $note->team_id;
        $canRestore = $canRestore && $bothInTeam;

        if ($canRestore) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Note $note)
    {

        $canForceDelete = $this->canForceDelete($user);
        $bothInTeam = $user->team_id === $note->team_id;
        $canForceDelete = $canForceDelete && $bothInTeam;

        if ($canForceDelete) {
            return true;
        }

    }
}
