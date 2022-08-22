<?php

namespace App\Policies;

class Permissions
{
     const CAN_UPDATE=1;
     const CAN_DELETE=2;
     const CAN_RESTORE=4;
     const CAN_FORCE_DELETE=8;
     const CAN_CREATE=16;
     const CAN_VIEW=128;
     const IS_ADMIN=31;
     const CAN_BAN_USER=32;
     const IS_SUPER_ADMIN=63;

// a user :CAN_UPDATE=1;CAN_DELETE=2;CAN_CREATE=16;CAN_VIEW=128
//
// the admin : what user can plus  CAN_FORCE_DELETE=8;CAN_RESTORE=4;
// the super admin works in all domains  and can: what admin can plus BAN_USER=32

//if ($user->permissions  & App \Policies\Permissons::Update) {...}
// to add per $a|$b (
//$a=1,$b=2,
// $c=$a | $b // (100000 + 010000 =110000)=3;
//  $r=$c & $a //1 again 110000+100000=100000;
// to check permiss if ($permissuo & CheckPermisson::Can_update)

}
