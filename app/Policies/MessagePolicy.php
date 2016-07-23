<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Message;

class MessagePolicy
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

    public function delete(User $user, Message $message)
    {
        if ($message->type) {
            return $user->owns($message);
        } else {
            if ($user->id == $message->receiver_id) {
                return true;
            }
        }
        return false;
    }
}
