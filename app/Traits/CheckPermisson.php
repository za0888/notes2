<?php

namespace App\Traits;

use App\Models\User;
use App\Policies\Permissions;
use Illuminate\Database\Eloquent\Model;

trait CheckPermisson
{

    public function canUpdate(User $user)
    {

        if ($user?->permissions & Permissions::CAN_UPDATE) {
            return true;
        }
    }

    public function canDelete(User $user)
    {

        if ($user?->permissions & Permissions::CAN_DELETE) {
            return true;
        }
    }

    public function canCreate(User $user)
    {
        if ($user?->permissions & Permissions::CAN_CREATE) {
            return true;
        }
    }

    public function canForceDelete(User $user)
    {
        if ($user?->permissions & Permissions::CAN_FORCE_DELETE) {
            return true;
        }
    }

    public function canView(User $user)
    {
        if ($user?->permissions & Permissions::CAN_VIEW) {
            return true;
        }
    }

    public function canRestore(User $user)
    {
        if ($user?->permissions & Permissions::CAN_RESTORE) {
            return true;
        }
    }

    public function canBanUser(User $user)
    {
        if ($user?->permissions & Permissions::CAN_BAN_USER) {
            return true;
        }
    }

    public function isAdmin(User $user)
    {
        if (
            $user?->permissions & Permissions::CAN_VIEW &&
            $user?->permissions & Permissions::CAN_FORCE_DELETE &&
            $user?->permissions & Permissions::CAN_DELETE &&
            $user?->permissions & Permissions::CAN_RESTORE &&
            $user?->permissions & Permissions::CAN_UPDATE&&
            $user?->permissions & Permissions::CAN_CREATE
        ) {
            return true;
        }
    }

    public function isSuperAdmin(User $user)
    {
        if ($user?->permissions & Permissions::CAN_BAN_USER &&
            $user?->permissions & Permissions::CAN_VIEW &&
            $user?->permissions & Permissions::CAN_FORCE_DELETE &&
            $user?->permissions & Permissions::CAN_DELETE &&
            $user?->permissions & Permissions::CAN_RESTORE &&
            $user?->permissions & Permissions::CAN_UPDATE&&
            $user?->permissions & Permissions::CAN_CREATE
        ) {
            return true;
        }
    }

}
