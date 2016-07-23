<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use App\Tag;
use App\User;
use App\Comment;

class ArticleController extends Controller
{
    public function index()
    {
        $this->authorize('createArticle', \Auth::user());

        $models = \Auth::user()->articles()->latest()->paginate(10);

        return view('article.index', compact('models'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('createArticle', \Auth::user());

        $tags = Tag::lists('name', 'id');
        $is_visible = [1 => 'да', 0 => 'нет'];
        $is_sticky = [0 => 'нет', 1 => 'да'];
        $is_closed = [0 => 'нет', 1 => 'да'];

        return view('article.create',
            compact('tags', 'is_visible', 'is_sticky', 'is_closed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Requests\ArticleRequest $request)
    {
        $this->authorize('createArticle', \Auth::user());

        if ($request->user_id != \Auth::user()->id) {
            return redirect('/article/create')
                ->withInput()
                ->with('flash_warning', 'Неверный автор.');
        }

        $user = User::findOrFail($request->user_id);
        // $article = \Auth::user()->articles()->save(new Article($request->all()));
        $article = $user->articles()->save(new Article($request->all()));
        $article->tags()->attach($request->input('tag_list'));
        $article->slug = $article->id.'-'.str_slug($request->title, '-');
        $article->save();
        if ($request->image) {
            $imageExt = $request->image->getClientOriginalExtension();
            $imageName = $article->id.'.'.$imageExt;
            $article->image = $imageName;
            $article->save();

            $destinationPath = base_path().config('app.uploads_articles_path');
            $request->image->move(
                $destinationPath.'/'.$article->id,
                $imageName
            );
        }

        return redirect('/')->with('flash_success', 'Новость успешно создана.');
    }

    public function show(Article $article)
    {
        if (!$article->is_visible and \Auth::guest()) {
            return abort(403);
        }
        if (\Auth::check() and !is_admin_role(\Auth::user())) {
            if (!$article->is_visible and !\Auth::user()->owns($article)) {
                return abort(403);
            }
        }

        return view('article.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('editArticle', $article);

        $tags = Tag::lists('name', 'id');
        $is_visible = [1 => 'да', 0 => 'нет'];
        $is_sticky = [0 => 'нет', 1 => 'да'];
        $is_closed = [0 => 'нет', 1 => 'да'];
        $users = User::lists('name', 'id');

        if (!is_admin_role(\Auth::user())) {
            $users = null;
        }

        return view('article.edit',
            compact('article', 'tags', 'is_visible', 'is_sticky', 'is_closed', 'users'));
    }

    public function update(Requests\ArticleRequest $request, Article $article)
    {
        $this->authorize('editArticle', $article);

        if (!is_admin_role(\Auth::user())) {
            if ($request->user_id != \Auth::user()->id) {
                return redirect('/article/'.$article->slug.'/edit')
                ->withInput()
                ->with('flash_warning', 'Неверный автор.');
            }
        }

        $data = $request->all();
        if ($request->image) {
            $destinationPath = base_path().config('app.uploads_articles_path');

            // delete image
            $image = $destinationPath.'/'.$article->id.'/'.$article->image;
            if (file_exists($image)) {
                unlink($image);
            }

            $imageExt = $request->image->getClientOriginalExtension();
            $imageName = $article->id.'.'.$imageExt;
            $article->image = $imageName;
            $article->save();

            $request->image->move(
                $destinationPath.'/'.$article->id,
                $imageName
            );
        }
        unset($data['image']);
        $article->update($data);
        $article->tags()->sync($request->input('tag_list'));
        // \Auth::user()->articles()->save($article);

        return redirect('/')->with('flash_success', 'Новость успешно обновлена.');
    }

    public function destroyImage(Article $article)
    {
        $this->authorize('editArticle', $article);

        $article->image = null;
        $article->save();

        $avatarDir = base_path().config('app.uploads_articles_path').'/'.$article->id;
        if (is_dir($avatarDir)) {
            system("rm -rf ".escapeshellarg($avatarDir));
        }

        return back()
            ->with('flash_success', 'Картинка успешно удалена.');
    }
}
