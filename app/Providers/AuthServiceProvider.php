<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
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
        Gate::define('is-admin', function (User $user) {
            foreach($user->roles as $role){
                if($role->name == 'admin'){
                    return true;
                }
            }
            return false;
        });
        // Quyền quản lý unit
        Gate::define('view_unit', function (User $user) {
            return $user->hasAccess(['view_unit']) ;
        });
        Gate::define('update_unit', function (User $user) {
            return $user->hasAccess(['update_unit']) ;
        });
        // Quyền quản lý branch
        Gate::define('view_all_branch', function (User $user) {
            return $user->hasAccess(['view_all_branch']) ;
        });
        Gate::define('view_branch', function (User $user) {
            return $user->hasAccess(['view_branch']) ;
        });
        Gate::define('create_branch', function (User $user) {
            return $user->hasAccess(['create_branch']) ;
        });
        Gate::define('update_branch', function (User $user) {
            return $user->hasAccess(['update_branch']) ;
        });
        Gate::define('delete_branch', function (User $user) {
            return $user->hasAccess(['delete_branch']) ;
        });
        // Quyền quản lý department
        Gate::define('view_department', function (User $user) {
            return $user->hasAccess(['view_department']) ;
        });
        Gate::define('create_department', function (User $user) {
            return $user->hasAccess(['create_department']) ;
        });
        Gate::define('update_department', function (User $user) {
            return $user->hasAccess(['update_department']) ;
        });
        Gate::define('delete_department', function (User $user) {
            return $user->hasAccess(['delete_department']) ;
        });
        // Quyền quản lý tài sản (assets)
        Gate::define('view_assets', function (User $user) {
            return $user->hasAccess(['view_assets']) ;
        });
        Gate::define('create_assets', function (User $user) {
            return $user->hasAccess(['create_assets']) ;
        });
        Gate::define('update_assets', function (User $user) {
            return $user->hasAccess(['update_assets']) ;
        });
        Gate::define('delete_assets', function (User $user) {
            return $user->hasAccess(['delete_assets']) ;
        });
        // Quyền quản lý user
        Gate::define('view_user', function (User $user) {
            return $user->hasAccess(['view_user']) ;
        });
        Gate::define('create_user', function (User $user) {
            return $user->hasAccess(['create_user']) ;
        });
        Gate::define('update_user', function (User $user) {
            return $user->hasAccess(['update_user']) ;
        });
        Gate::define('delete_user', function (User $user) {
            return $user->hasAccess(['delete_user']) ;
        });
      // Quyền quản lý role
        Gate::define('view_role', function (User $user) {
            return $user->hasAccess(['view_role']) ;
        });
        Gate::define('create_role', function (User $user) {
            return $user->hasAccess(['create_role']) ;
        });
        Gate::define('update_role', function (User $user) {
            return $user->hasAccess(['update_role']) ;
        });
        Gate::define('delete_role', function (User $user) {
            return $user->hasAccess(['delete_role']) ;
        });
        // Quyền quản lý permission
        Gate::define('view_permission', function (User $user) {
            return $user->hasAccess(['view_permission']) ;
        });
        Gate::define('create_permission', function (User $user) {
            return $user->hasAccess(['create_permission']) ;
        });
        Gate::define('update_permission', function (User $user) {
            return $user->hasAccess(['update_permission']) ;
        });
        Gate::define('delete_permission', function (User $user) {
            return $user->hasAccess(['delete_permission']) ;
        });
        // Nhà cung cấp
         Gate::define('view_provide', function (User $user) {
            return $user->hasAccess(['view_provide']) ;
        });
        Gate::define('create_provide', function (User $user) {
            return $user->hasAccess(['create_provide']) ;
        });
        Gate::define('update_provide', function (User $user) {
            return $user->hasAccess(['update_provide']) ;
        });
        Gate::define('delete_provide', function (User $user) {
            return $user->hasAccess(['delete_provide']) ;
        });
       
        // Loại sản phẩm
        Gate::define('view_property_type', function (User $user) {
            return $user->hasAccess(['view_property_type']) ;
        });
        Gate::define('create_property_type', function (User $user) {
            return $user->hasAccess(['create_property_type']) ;
        });
        Gate::define('update_property_type', function (User $user) {
            return $user->hasAccess(['update_property_type']) ;
        });
        Gate::define('delete_property_type', function (User $user) {
            return $user->hasAccess(['delete_property_type']) ;
        });

          // nhóm sản phẩm
          Gate::define('view_property_group', function (User $user) {
            return $user->hasAccess(['view_property_group']) ;
        });
        Gate::define('create_property_group', function (User $user) {
            return $user->hasAccess(['create_property_group']) ;
        });
        Gate::define('update_property_group', function (User $user) {
            return $user->hasAccess(['update_property_group']) ;
        });
        Gate::define('delete_property_group', function (User $user) {
            return $user->hasAccess(['delete_property_group']) ;
        });
    }
}
