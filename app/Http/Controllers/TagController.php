<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $articles = $tag->articles()->where('is_visible', true)->latest()->paginate(10);

        return view('tag.show', compact('articles', 'tag'));
    }
}
