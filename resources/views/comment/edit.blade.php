@extends('layouts.app')

@section('title', 'Редактировать комментарий')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Редактировать комментарий</div>

        <div class="panel-body">
          {!! Form::model($comment, [
            'method' => 'PATCH',
            'action' => ['CommentController@update', $comment->id]])
          !!}
            @include('comment._form', ['submitButton' => 'Обновить'])
          {!! Form::close() !!}
          @can('deleteComment', \Auth::user())
            {!! delete_to_route(['comment.destroy', $comment->id]) !!}
          @endcan
        </div>
      </div>
    </div>
  </div>
</div>
@stop
