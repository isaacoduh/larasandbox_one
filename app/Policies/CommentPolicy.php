<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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

    // can user view the comment
    public function view(User $user, Comment $comment)
    {
        return true;
    }

    // can user create comments
    public function create(User $user)
    {
        return true;
    }

    // can user update the comment
    public function update(User $user, Comment $comment)
    {
        return $comment->user_id === $user->id;
    }

    // can user delete comment
    public function delete(User $user, Comment $comment)
    {
        return $comment->user_id === $user->id;
    }

    // can user restore comment
    public function restore(User $user, Comment $comment)
    {
        return false;
    }

    // can user force delete comment
    public function forceDelete(User $user, Comment $comment)
    {
        return false;
    }
}
