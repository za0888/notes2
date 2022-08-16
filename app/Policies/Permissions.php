<?php

namespace App\Policies;

class Permissions
{
     const CAN_UPDATE=1;
     const CAN_DELETE=2;
     const CAN_RESTORE=4;
     const CAN_FORCE_DELETE=8;
     const CAN_CREATE=16;
     const CAN_EDIT=32;

//if ($user->permissions  & App \Policies\Permissions::FINISHED_DELETE) {...}
// to add per $a|$b (
//$a=1,$b=2, $c=$a | $b //3;  $r=$c & $a //1 again
// to check permiss if ($permissuo & Permissions::Can_update)

}
