@extends('layouts.app')

@section('title', 'Редактировать '.$article->title)

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Редактировать {{ $article->title }}</div>

        <div class="panel-body">
          @if ($article->image)
            <img src="/uploads/articles/{{ $article->id }}/{{ $article->image }}"
              alt="{{ $article->title }}" class="thumbnail" width="200">
            {!! delete_to_route(['article.avatar.destroy', $article->slug]) !!}
            <hr>
          @endif
          {!! Form::model($article, [
            'method' => 'PATCH',
            'action' => ['ArticleController@update', $article->slug],
            'files' => true])
          !!}
            @include('article._form', ['submitButton' => 'Обновить'])
          {!! Form::close() !!}
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

      new SimpleMDE();

    }());
  </script>
@stop
