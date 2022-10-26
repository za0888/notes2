<?php

namespace App\Policies;

class Permissions
{
//     const CAN_UPDATE=Permission::canUpdate()->get()->value('value');
     const CAN_UPDATE=1;
     const CAN_DELETE=2;
     const CAN_RESTORE=4;
     const CAN_FORCE_DELETE=8;
     const CAN_CREATE=16;
     const CAN_VIEW=128;
     const IS_ADMIN=415;
     const IS_SUPER_ADMIN=447;
     const CAN_CONTROL_USER=256;
     const CAN_BAN_USER=32;
     const BANED_USER=0;

     const ALL_PERMISSIONS_NAMES=[
        'CAN_UPDATE',
        'CAN_DELETE',
        'CAN_RESTORE',
        'CAN_CREATE',
        'CAN_VIEW',
        'BANED_USER',
        'IS_ADMIN',
        'CAN_BAN_USER',
        'CAN_FORCE_DELETE',
         'IS_SUPER_ADMIN',
         'CAN_CONTROL_USER'
         ];

//      IMPORTANT!!! Don't wipe out what you see below
// a user :CAN_UPDATE=1;CAN_DELETE=2;CAN_CREATE=16;CAN_VIEW=128
//
// the admin : what user can plus  CAN_FORCE_DELETE=8;CAN_RESTORE=4;
// the super admin works in all domains  and can: what admin can plus BAN_USER=32

//if ($user->permissions  & App \Policies\Permissons::Update) {...}
// to add pemission $a|$b (
//$a=1,$b=2,(a=0001, b=0010 so a|b=0011=3
// $c=$a | $b // (0001 + 0010 =0011)=3;'|' returns a binary number with all bits set that are set in either operand.
// so $c includes both CAN_VIEW, CAN_DELETE ( each bit is owned by its permission)
//and vice verse  to check
//  $r=$c & $a //1 again 0011 & 0001 =0001;'&' returns a binary number in which all bits are set that are set in both
// to check permiss if ($permissuo & HasPermissons::Can_update)

}
