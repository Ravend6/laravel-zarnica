@extends('layouts.app')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Добро пожаловать</div>

        <div class="panel-body">
          <div class="jumbotron">
            <h1>Сoming Soon</h1>
            <p>Портал в разработке.</p>
            {{-- <p><a class="btn btn-primary btn-lg disabled">Узнать больше</a></p> --}}
            <p><a href="{{ route('page.plan') }}" class="btn btn-primary btn-lg">Узнать больше</a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Закрепленные новости</div>
        <div class="panel-body">
          @forelse ($stickyArticles as $stickyArticle)
            <article class="news clearfix">
              <h3>
                @if ($stickyArticle->is_sticky)
                  <i class="fa fa-paperclip"></i>
                @endif
                @if ($stickyArticle->is_closed)
                  <i class="fa fa-lock"></i>
                @endif
                <a href="{{ route('article.show', [$stickyArticle->slug]) }}">
                {{ $stickyArticle->title }}</a>
              </h3>
              <p>
                <span>автор
                  @if ($stickyArticle->user)
                    <a href="/profile/{{ $stickyArticle->user->id }}">{{ $stickyArticle->user->name }}</a>
                  @else
                    удален
                  @endif
                </span>
                <span class="pull-right">создано {{ $stickyArticle->created_at->diffForHumans() }}</span>
              </p>
              <p>
                <span>
                  <i class="fa fa-tags"></i>
                  @foreach ($stickyArticle->tags as $tag)
                    <a href="{{ route('tag.show', [$tag->id]) }}">{{ $tag->name }}</a>
                  @endforeach
                </span>
                @can('editArticle', $stickyArticle)
                  <span class="pull-right">
                    <a href="{{ route('article.edit', [$stickyArticle->slug]) }}" data-toggle="tooltip" data-placement="left" title="Редактировать">
                      <i class="fa fa-pencil"></i>
                    </a>
                  </span>
                @endcan
              </p>
              @if ($stickyArticle->image)
                <a href="{{ route('article.show', [$stickyArticle->slug]) }}">
                  <img class="article-image thumbnail"
                    src="/uploads/articles/{{ $stickyArticle->id }}/{{ $stickyArticle->image }}"
                    alt="{{ $stickyArticle->title }} image">
                </a>
              @endif
              <p>{!! str_limit(Helper::markdownRender($stickyArticle->body), 360) !!}</p>
              <a href="{{ route('article.show', [$stickyArticle->slug]) }}" class="pull-right" data-toggle="tooltip" data-placement="top" title="Количество комментариев">
                <i class="fa fa-btn fa-comments"></i>{{ $stickyArticle->comments->count() }}</a>
              {{-- <p class="pull-right" data-toggle="tooltip" data-placement="top" title="Количество комментариев">
                <i class="fa fa-btn fa-comments"></i>{{ $stickyArticle->comments->count() }}</p> --}}
            </article>
            <hr>
          @empty
            <div>Новостей еще нет</div>
          @endforelse
        </div>
      </div>
    </div>
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Новости</div>
        <div class="panel-body">
          @forelse ($articles as $article)
            <article class="news clearfix">
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
                <span class="pull-right">создано {{ $article->created_at->diffForHumans() }}</span>
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
              <p>{!! str_limit(Helper::markdownRender($article->body), 360) !!}</p>
              <a href="{{ route('article.show', [$article->slug]) }}" class="pull-right" data-toggle="tooltip" data-placement="top" title="Количество комментариев">
                <i class="fa fa-btn fa-comments"></i>{{ $article->comments->count() }}</a>
              {{-- <p class="pull-right" data-toggle="tooltip" data-placement="top" title="Количество комментариев">
                <i class="fa fa-btn fa-comments"></i>{{ $article->comments->count() }}</p> --}}
            </article>
            <hr>
          @empty
            <div>Новостей еще нет</div>
          @endforelse
          {!! $articles->links() !!}
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
