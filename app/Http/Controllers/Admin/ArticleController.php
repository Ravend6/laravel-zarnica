<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $models = Article::latest()->paginate(10);

        return view('admin.article.index', compact('models'));
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            $imageDir = base_path().config('app.uploads_articles_path').'/'.$article->id;
            if (is_dir($imageDir)) {
                system("rm -rf ".escapeshellarg($imageDir));
            }
        }
        $article->delete();

        return redirect('/admin/article')->with('flash_success', 'Новость успешно удалена.');
    }
}
