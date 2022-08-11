<?php

namespace App\Scopes;

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

        $user=auth()->user();

        if ($user){

            $trusteds=$user->trusteds()->get('trusted_user');

            $is_admin=$user ??-$user->is_admin->toArray();
        }



        if (!$is_admin) {
            $builder->where('created_by_user', auth()->id());
        }
    }

}
