<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('profileActions', \Auth::user());

        $readReceivedMessages = Message::where('receiver_id', \Auth::user()->id)
            ->where('type', false)
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($readReceivedMessages as $message) {
            $message->is_read = true;
            $message->save();
        }

        $receivedMessages = Message::where('receiver_id', \Auth::user()->id)
            ->where('type', false)
            ->orderBy('created_at', 'desc')
            ->paginate(2);
        $sentMessages = Message::where('user_id', \Auth::user()->id)
            ->where('type', true)
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        return view('message.index', compact('receivedMessages', 'sentMessages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSend(User $user)
    {
        $this->authorize('sendMessage', $user);

        $readMessages = Message::where('receiver_id', \Auth::user()->id)
            ->where('user_id', $user->id)
            ->where('type', false)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($readMessages as $message) {
            $message->is_read = true;
            $message->save();
        }

        $messages = Message::where('receiver_id', \Auth::user()->id)
            ->where('user_id', $user->id)
            ->where('type', false)
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('message.send', compact('user', 'messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postSend(Requests\MessageRequest $request, User $user)
    {
        $this->authorize('sendMessage', $user);

        $message = new Message();
        $message->user_id = \Auth::user()->id;
        $message->receiver_id = $user->id;
        $message->body = $request->body;
        $message->save();

        $myMessage = new Message();
        $myMessage->user_id = \Auth::user()->id;
        $myMessage->receiver_id = $user->id;
        $myMessage->body = $request->body;
        $myMessage->is_read = true;
        $myMessage->type = true;
        $myMessage->save();

        return back()->with('flash_success', 'Сообщение успешно отправлено.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $this->authorize('profileActions', \Auth::user());
        $this->authorize('delete', $message);
        $message->delete();

        return back()->with('flash_success', 'Сообщение успешно удалено.');
    }
}
