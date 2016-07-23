<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Friend;
use App\Message;

class UserPolicy
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

    public function showAdminpanel(User $user)
    {
        if (is_admin_role($user)) return true;

        return false;
    }

    public function isAdmin(User $user)
    {
        if (is_admin_role($user)) return true;

        return false;
    }

    public function isBanned(User $user)
    {
        foreach ($user->banneds as $banned) {
            if ($banned->ended_at > new \DateTime()) {
                return false;
            }
        }

        return true;
    }

    public function createArticle(User $user)
    {
        if ($this->isBadStatus($user)) return false;
        if (is_admin_role($user) or is_newsmaker_role($user)) return true;
        return false;
    }

    public function createComment(User $user)
    {
        if ($this->isBadStatus($user)) return false;
        if ($user->status == 'active') return true;
        return false;
    }

    public function deleteComment(User $user)
    {
        if ($this->isBadStatus($user)) return false;
        if (is_admin_role($user)) {
            return true;
        }

        return false;
    }

    public function profileActions(User $user)
    {
        if ($this->isBadStatus($user)) return false;
        return true;
    }

    public function addFriend(User $user, User $friend)
    {
        if ($this->isBadStatus($user)) return false;
        if ($user->id == $friend->id) return false;
        foreach ($user->friends as $f) {
            if ($f->friend_id == $friend->id) {
                return false;
            }
        }
        return true;
        // return $user->owns($album);
    }

    public function removeFriend(User $user, User $friend)
    {
        if ($this->isBadStatus($user)) return false;
        if ($user->id == $friend->id) return false;
        foreach ($user->friends as $f) {
            if ($f->friend_id == $friend->id) {
                return true;
            }
        }
        return false;
    }

    public function sendMessage(User $user, User $userCheck)
    {
        if ($this->isBadStatus($user)) return false;
        if ($user->id != $userCheck->id) {
            return true;
        }
        return false;
    }

    public function removeAccount(User $user, User $userCheck)
    {
        if ($this->isBadStatus($user)) return false;

        return true;
    }

    public function activatedAccount(User $user, User $userCheck)
    {
        if ($user->status == 'deleted') return true;

        return false;
    }
}
