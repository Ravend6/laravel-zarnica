<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Comment;
use App\User;

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

    private function isBadStatus(User $user)
    {
        if ($user->status == 'banned' or $user->status == 'deleted') {
            return true;
        } else {
            return false;
        }
    }

    public function editComment(User $user, Comment $comment)
    {
        if ($this->isBadStatus($user)) return false;
        if (is_admin_role($user) or $user->owns($comment)) {
            return true;
        }

        return false;
    }
}
