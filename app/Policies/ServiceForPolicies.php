<?php

namespace App\Policies;

use App\Models\Media;
use App\Models\Trusted;
use App\Models\User;
use App\Models\Note;
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
            $this->denyWithStatus(466, 'Must have admin rights');
    }


    public function ifModelCreatedByUser(User $user, Note|Theme|Category|SubCategory|Media|Trusted $model)
    {
        return $user->id === $model->created_by_user ? $this->allow() :
            $this->denyWithStatus(466);
    }

    public function isTrustedUser(User $user, Note|Theme|Category|SubCategory|Media|Trusted $model): bool
    {
        $created_by_id = $model->created_by_user->id;
        $UserTrustedsToArray = User::find($created_by_id)
            ->trusteds()
            ->get('trusted_user')
            ->pluck('trusted_user')
            ->toArray();

        return in_array(
            $user->id, $UserTrustedsToArray
        );
    }
}
