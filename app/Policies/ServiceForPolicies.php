<?php

namespace App\Policies;

use App\Models\Media;
use App\Models\User;
use App\Models\Note;
use App\Models\Theme;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\CheckPermisson;
use Tests\CreatesApplication;

class ServiceForPolicies

{
    use HandlesAuthorization;
    use CheckPermisson;


}
