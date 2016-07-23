<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CommentRequest $request)
    {
        $this->authorize('createComment', \Auth::user());

        $comment = new Comment;
        $comment->user_id = \Auth::user()->id;
        $comment->article_id = $request->article_id;
        $comment->body = $request->body;
        $comment->save();

        return back()->with('flash_success', 'Комментарий успешно отправлен.');
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
    public function edit(Comment $comment)
    {
        $this->authorize('editComment', $comment);

        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CommentRequest $request, Comment $comment)
    {
        $this->authorize('editComment', $comment);

        $comment->body = $request->body;
        $comment->save();

        return redirect(route('article.show', [$comment->article->slug]))
            ->with('flash_success', 'Комментарий успешно обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('deleteComment', \Auth::user());

        $comment->delete();

        return redirect(route('article.show', [$comment->article->slug]))
            ->with('flash_success', 'Комментарий успешно удален.');
    }
}
