<?php

namespace App\Traits;

use App\Scopes\TeamScope;
use Illuminate\Support\Facades\Auth;

trait TeamFilter
{
    protected static function booted()
    {
        static::addGlobalScope(new TeamScope);
        if (Auth::user()) {

            static::creating(function ($model) {
                $model->team_id = \Auth::user()->team_id;

            });
        }

    }

}
