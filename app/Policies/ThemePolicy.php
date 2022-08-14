<?php

namespace App\Policies;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThemePolicy extends ServiceForPolicies
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->is_admin) {
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
        return
            $this->ifModelCreatedByUser($user, $theme)
            ||
            $this->ifModelCreatedByUser($user, $theme);

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
     * @param \App\Models\Theme $theme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Theme $theme)
    {
        return $this->ifModelCreatedByUser($user, $theme);
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
        return $this->ifModelCreatedByUser($user, $theme);
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
        return $this->ifModelCreatedByUser($user, $theme);
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
        return $this->ifIsAdmin();
    }
}
