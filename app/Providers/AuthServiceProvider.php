<?php

namespace App\Providers;

use App\Models\Content;
use App\Models\Post;
use App\Models\User;
use App\Policies\ContentPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
   
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
        Content::class =>ContentPolicy::class

    ];
    public function boot()
    {
        $this->registerPolicies();
        // các gate khai báo ở đây, và cấp quyền cho tài khoản có quyền truy cập vào
        // đường dẫn nào ở trang blade.php
        Gate::define('is-admin', function (User $user) {
            foreach($user->roles as $role){
                if($role->name == 'admin'){
                    return true;
                }
            }
            return false;
        });
        Gate::define('view_content', function (User $user) {
            return $user->hasAccess(['view_content']) ;
        });
        Gate::define('create_content', function (User $user) {
            return $user->hasAccess(['create_content']) ;
        });
        Gate::define('update_content', function (User $user) {
            return $user->hasAccess(['update_content']) ;
        });
        Gate::define('delete_content', function (User $user) {
            return $user->hasAccess(['delete_content']) ;
        });

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
        Gate::define('change_role', function (User $user) {
            return $user->hasAccess(['change_role']) ;
        });

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
        Gate::define('download_content', function (User $user) {
            return $user->hasAccess(['download_content']) ;
        });
    }
}
