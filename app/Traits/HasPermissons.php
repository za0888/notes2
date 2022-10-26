<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Permission;
use App\Policies\Permissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait HasPermissons
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

    public function canControlUser(User $user)
    {
        if ($user?->permissions & Permissions::CAN_CONTROL_USER) {
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
            $user?->permissions & Permissions::CAN_UPDATE &&
            $user?->permissions & Permissions::CAN_CREATE &&
            $user?->permissions & Permissions::CAN_CONTROL_USER

        ) {
            return true;
        }
    }

    public function isSuperAdmin(User $user)
    {
        if (
            $user?->permissions & Permissions::CAN_BAN_USER && //plus to admin cans
            $user?->permissions & Permissions::CAN_VIEW &&
            $user?->permissions & Permissions::CAN_FORCE_DELETE &&
            $user?->permissions & Permissions::CAN_DELETE &&
            $user?->permissions & Permissions::CAN_RESTORE &&
            $user?->permissions & Permissions::CAN_UPDATE &&
            $user?->permissions & Permissions::CAN_CREATE &&
            $user?->permissions & Permissions::CAN_CONTROL_USER

        ) {
            return true;
        }
    }

    public function givePermissionTo(string|array $permissionName)
    {
        if (is_string($permissionName) && in_array($permissionName,Permissions::ALL_PERMISSIONS_NAMES)) {
            $this->permissions = $this->permissions | $permissionName;
            $this->save();
        }

        if (is_array($permissionName)) {
            foreach ($permissionName as $permissionItem) {
                $this->permissions = $this->permissions | $permissionItem;
            }
        }
    }

}
