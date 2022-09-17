<?php

namespace App\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Session;
use App\Traits\CheckPermisson;
class TeamScope implements Scope
{
    use CheckPermisson;

    public function apply(Builder $builder, Model $model)
    {

        $user = auth()->user();
        if (!$user) {
            return;
        }

        if (!$this->isSuperAdmin($user)) {
            $builder->where('team_id', $user->team_id);
        }


    }

}
