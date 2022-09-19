<?php

namespace App\Scopes;

use App\Policies\Permissions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Session;

class OnlyUserScope implements Scope

{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */

    public function apply(Builder $builder, Model $model)
    {

        $user = auth()->user();

        if ($user) {
            $is_super_admin = $user->permissions === Permissions::IS_SUPER_ADMIN ?? false;
        }


        if (!$is_super_admin) {
            $builder->where('created_by_user', auth()->id());
        }

    }

}
