<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Models\Note;
use App\Models\SubCategory;
use App\Models\Theme;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\NotePolicy;
use App\Policies\SubCategoryPolicy;
use App\Policies\ThemePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//        Auto-discovery will be used
//        https://laravel.com/docs/9.x/authorization#policy-auto-discovery

        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
