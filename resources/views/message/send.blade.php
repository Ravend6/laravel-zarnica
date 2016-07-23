@extends('layouts.app')

@section('title', 'Отправить сообщение '.$user->name)

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Отправить сообщение {{ $user->name }}</div>

        <div class="panel-body">
          {!! Form::open([
            'method' => 'POST',
            'action' => ['MessageController@postSend', $user->id]
            ]) !!}
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
              {!! Form::label('body', 'Текст:', ['class' => 'control-label']) !!}
              {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
              @if ($errors->has('body'))
              <span class="help-block">{{ $errors->first('body') }}</span>
              @endif
            </div>
            <div class="form-group">
              {!! Form::submit('Отправить', ['class' => 'btn btn-primary']) !!}
            </div>
          {!! Form::close() !!}
          <hr>
          <h4 class="page-header">Полученые сообщения от {{ $user->name }}</h4>
          @forelse ($messages as $message)
            <div>
              <span>{{ $message->user->name }}</span>
              {{-- <span>{{ $message->is_read }}</span> --}}
              <span>{{ $message->created_at->diffForHumans() }}</span>
              <p>
                {!! Helper::markdownRender($message->body) !!}
              </p>
              <p>
                {!! delete_to_route(['message.destroy', $message->id]) !!}
              </p>
            </div>
          @empty
            <p>Сообщений еще нет</p>
          @endforelse
          {!! $messages->links() !!}
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

      // $("input[name='title']").on('keyup', function (e) {
      //   e.preventDefault();
      //
      //   $.ajax({
      //     url: '/api/v1/articles/generate-slug',
      //     method: 'post',
      //     data: {
      //       // _method: 'delete',
      //       'title': $(this).val(),
      //       _token: $(this).data('csrf')
      //     },
      //   }).done(function (data, status, req) {
      //     $("input[name='slug']").val(data);
      //   }).fail(function (err) {
      //     console.log(err);
      //   });
      // });

      new SimpleMDE();

    }());
  </script>
@stop
