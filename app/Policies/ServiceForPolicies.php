<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Notes;
use App\Models\Theme;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceForPolicies

{
    use HandlesAuthorization;


    public function ifIsAdmin(User $user)
    {
        return $user->is_admin ? $this->allow() :
            $this->denyWithStatus(466);
    }



    public function ifModelCreatedByUser(User $user, Notes|Theme|Category|SubCategory $model)
    {
        return $user->id === $model->created_by_user ? $this->allow() :
            $this->denyWithStatus(466);
    }
}
