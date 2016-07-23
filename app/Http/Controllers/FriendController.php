<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Friend;

class FriendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdd(User $friend)
    {
        $this->authorize('addFriend', $friend);

        $newFriend = new Friend();
        $newFriend->user_id = \Auth::user()->id;
        $newFriend->friend_id = $friend->id;
        $newFriend->is_confirm = true;
        $newFriend->save();

        $userFriend = new Friend();
        $userFriend->user_id = $newFriend->friend_id;
        $userFriend->friend_id = \Auth::user()->id;
        $userFriend->save();

        return back()->with('flash_success', 'Заявка на дружбу успешно отправлена.');
    }

    public function getRemove(User $friend)
    {
        $this->authorize('removeFriend', $friend);

        $delFriend = Friend::where('friend_id', $friend->id)
            ->where('user_id', \Auth::user()->id)
            ->firstOrFail();
        $delFriend->delete();

        $delUserFriend = Friend::where('user_id', $friend->id)
            ->where('friend_id', $delFriend->user_id)
            ->firstOrFail();
        $delUserFriend->delete();

        return back()->with('flash_success', 'Друг успешно удален или отклонен.');
    }

    public function getConfirm()
    {
        return view('friend.confirm');
    }

    public function getConfrimAdd(Friend $friend)
    {
        $sendFriend = Friend::where('user_id', $friend->friend_id)
            ->where('friend_id', $friend->user_id)
            ->where('type', false)
            ->firstOrFail();
        $sendFriend->type = true;
        $sendFriend->save();

        $friend->is_confirm = true;
        $friend->type = true;
        $friend->save();

        return back()->with('flash_success', 'Вы успешно подружились.');
    }
}
