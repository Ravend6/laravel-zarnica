<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Article;

class ArticlePolicy
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

    public function editArticle(User $user, Article $article)
    {
        if ($this->isBadStatus($user)) return false;
        if (is_admin_role($user) or $user->owns($article)) {
            return true;
        }

        return false;

    }
}
