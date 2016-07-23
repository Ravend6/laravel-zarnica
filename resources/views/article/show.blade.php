@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{ $article->title }}</div>

        <div class="panel-body">
          <article class="news">
            <h3>
              @if ($article->is_sticky)
                <i class="fa fa-paperclip"></i>
              @endif
              @if ($article->is_closed)
                <i class="fa fa-lock"></i>
              @endif
              <a href="{{ route('article.show', [$article->slug]) }}">
              {{ $article->title }}</a>
            </h3>
            <p>
              <span>автор
                @if ($article->user)
                  <a href="/profile/{{ $article->user->id }}">{{ $article->user->name }}</a>
                @else
                  удален
                @endif
              </span>
              <span class="pull-right">Создано: {{ $article->created_at->diffForHumans() }}</span>
            </p>
            <p>
              <span>
                <i class="fa fa-tags"></i>
                @foreach ($article->tags as $tag)
                  <a href="{{ route('tag.show', [$tag->id]) }}">{{ $tag->name }}</a>
                @endforeach
              </span>
              @can('editArticle', $article)
                <span class="pull-right">
                  <a href="{{ route('article.edit', [$article->slug]) }}" data-toggle="tooltip" data-placement="left" title="Редактировать">
                    <i class="fa fa-pencil"></i>
                  </a>
                </span>
              @endcan
            </p>
            @if ($article->image)
              <a href="{{ route('article.show', [$article->slug]) }}">
                <img class="article-image thumbnail"
                  src="/uploads/articles/{{ $article->id }}/{{ $article->image }}"
                  alt="{{ $article->title }} image">
              </a>
            @endif
            <p>{!! Helper::markdownRender($article->body) !!}</p>
            <p class="pull-right" data-toggle="tooltip" data-placement="top" title="Количество комментариев">
              <i class="fa fa-btn fa-comments"></i>{{ $article->comments->count() }}</p>
          </article>
        </div>
      </div>
    </div>
    @can('createComment', Auth::user())
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Комментировать новость</div>

          <div class="panel-body">
            {!! Form::open([
              'method' => 'POST',
              'action' => ['CommentController@store']])
            !!}
              {{ Form::hidden('article_id', $article->id) }}
              @include('comment._form', ['submitButton' => 'Отправить'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    @endcan
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Комментарии к новости</div>

        <div class="panel-body">
          @forelse ($article->comments()->paginate(10) as $comment)
            <div class="media">
              <div class="media-left">
                @if ($comment->user)
                  @if ($comment->user->avatar)
                    <a href="/profile/{{ $comment->user->id }}">
                      <img src="/uploads/users/avatars/{{ $comment->user->id }}/{{ $comment->user->avatar }}"
                        alt="{{ $comment->user->name }} avatar" class="thumbnail media-object" width="60">
                    </a>
                  @else
                    <a href="/profile/{{ $comment->user->id }}">
                      <img src="/images/users/avatars/noavatar.png"
                        alt="{{ $comment->user->name }} avatar" class="thumbnail media-object" width="60">
                    </a>
                  @endif
                @else
                  <img src="/images/users/avatars/noavatar.png"
                    alt="User avatar" class="thumbnail media-object" width="60">
                @endif
              </div>
              <div class="media-body">
                <h5 class="media-heading">
                  @if ($comment->user)
                    <span>автор <a href="/profile/{{ $comment->user->id }}">{{ $comment->user->name }}</a></span>
                    @can('editComment', $comment)
                      <span class="pull-right" style="margin-left:10px">
                        <a href="{{ route('comment.edit', [$comment->id]) }}" data-toggle="tooltip" data-placement="top" title="Редактировать">
                          <i class="fa fa-pencil"></i>
                        </a>
                      </span>
                    @endcan
                  @else
                    автор удален
                  @endif
                  <span class="pull-right">создано {{ $comment->created_at->diffForHumans() }}</span>
                </h5>
                <p>
                  {!! nl2br(e($comment->body), false) !!}
                </p>
              </div>
            </div>
            <hr>
          @empty
            Комменатрий еще нет
          @endforelse
          {!! $article->comments()->paginate(10)->links() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
  <script>
    (function () {
      'use strict';

      $('.news img[alt="title"]').addClass('article-image thumbnail');
      $('.news img[alt="image"]').addClass('article-images');

    }());
  </script>
@stop
