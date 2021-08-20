<?php

namespace App\Policies;

use App\Models\Content;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Content $content)
    {
        return $user->hasAccess(['view_content']);
    }

    public function create(User $user)
    {
        return $user->hasAccess(['create_content']);
    }

    public function update(User $user, Content $content)
    {
        return $user->hasAccess(['update_content']);
    }

    public function delete(User $user, Content $content)
    {
        return $user->hasAccess(['delete_content']);
    }

    
    public function restore(User $user, Content $content)
    {
        //
    }

    public function forceDelete(User $user, Content $content)
    {
        //
    }
    public function download(User $user, Content $content)
    {
        return $user->hasAccess(['download_content']);
    }
}
