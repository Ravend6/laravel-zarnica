<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Banned;
use Carbon\Carbon;

class BannedController extends Controller
{
    public function postUserChat(Request $request, User $user)
    {
        $this->authorize('isAdmin', $user);

        if ($request->ajax()) {
            $banned = new Banned();
            $banned->admin = \Auth::user()->id;
            $banned->user_id = $user->id;
            $banned->ended_at = Carbon::now()->addDay();
            $banned->save();

            // return response()->json('success', 200);
            return $user;
        } else {
            return response()->json('error', 400);
        }
    }
}
