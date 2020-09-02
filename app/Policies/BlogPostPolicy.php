<?php

namespace App\Policies;

use App\BlogPost;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    // can a user update a blog post
    public function update(User $user, BlogPost $blogPost)
    {
        return $user->id == $blogPost->user_id;
    }

    // can a user delete a blog post
    public function delete(User $user, BlogPost $blogPost)
    {
        return $user->id == $blogPost->user_id;
    }

    /**
     * Other functions
     * - view
     * - create
     * - restore
     * - forceDelete
     */
}
