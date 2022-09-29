<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\CheckPermisson;
use Illuminate\Auth\Access\Response;

class NotePolicy
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
        else{
            return Response::denyAsNotFound('Alas. Sorry');
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
        $bothSameTeam = $user->team_id === $note->team_id;
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
//            return false;
           return Response::denyAsNotFound('You cannot create a Note. POLICY SAYS');
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
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Note $note)
    {
        if (!$user) {
           return Response::denyAsNotFound('You must be a User');
        }

        $canUpdate = $this->canUpdate($user);
        $bothSameTeam = $user->team_id === $note->team_id;
        $canUpdate = $canUpdate && $bothSameTeam;

        if ($canUpdate) {
            return Response::allow();
        }
        return Response::denyAsNotFound('NotFound my');
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
        if (!$user) {
            return false;
        }

        $canDelete = $this->canDelete($user);
        $bothSameTeam = $user->team_id === $note->team_id;
        $canDelete = $canDelete && $bothSameTeam;

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
        $bothSameTeam = $user->team_id === $note->team_id;
        $canRestore = $canRestore && $bothSameTeam;

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
        $bothSameTeam = $user->team_id === $note->team_id;
        $canForceDelete = $canForceDelete && $bothSameTeam;

        if ($canForceDelete) {
            return true;
        }

    }
}
