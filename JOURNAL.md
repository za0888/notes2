19.08.2022
## Remove indexes

**(unique)** for theme.category,subCategory.
Reasons:   
- all users have their own domain and so   theme names, category names... don't have   to be unique( I think so. For now)


##Error array to string conversion during seeding  
Check factory

## Permissions  
##### permissions.php

const CAN_UPDATE=1;
const CAN_DELETE=2;
const CAN_RESTORE=4;
const CAN_FORCE_DELETE=8;
const CAN_CREATE=16;
const BAN_USER=32;
const ADMIN=31;
const SUPER_ADMIN=63;

//if ($user->permissions  & App \Policies\CheckPermisson::FINISHED_DELETE) {...}
// to add per $a|$b (
//$a=1,$b=2, $c=$a | $b //3;  $r=$c & $a //1 again
// to check permiss if ($permissuo & CheckPermisson::Can_update)




