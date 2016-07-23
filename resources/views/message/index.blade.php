@extends('layouts.app')

@section('title', Auth::user()->name.' сообщения')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{ Auth::user()->name }} полученые сообщения</div>

        <div class="panel-body">
          @forelse ($receivedMessages as $message)
            <div>
              <p>От кого: <a href="/profile/{{ $message->user_id }}">{{ $message->user->name }}</a></p>
              {{-- <p>{{ $message->is_read }}</p> --}}
              <p>{{ $message->created_at->diffForHumans() }}</p>
              <p>
                {!! Helper::markdownRender($message->body) !!}
              </p>
              <p>
                <a href="{{ route('message.send', [$message->user_id]) }}" class="btn btn-success btn-sm">
                  <i class="fa fa-btn fa-envelope"></i>Отправить сообщение</a>
              </p>
              <p>
                {!! delete_to_route(['message.destroy', $message->id]) !!}
              </p>
            </div>
            <hr>
          @empty
            <p>Сообщений еще нет</p>
          @endforelse
          {!! $receivedMessages->links() !!}
        </div>
      </div>
    </div>
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{ Auth::user()->name }} отправленые сообщения</div>

        <div class="panel-body">
          @forelse ($sentMessages as $message)
            <div>
              <p>Кому: <a href="/profile/{{ $message->receiver_id }}">
                {{ $message->receiver->name }}</a></p>
              {{-- <p>{{ $message->is_read }}</p> --}}
              <p>{{ $message->created_at->diffForHumans() }}</p>
              <p>
                {!! Helper::markdownRender($message->body) !!}
              </p>
              <p>
                <a href="{{ route('message.send', [$message->receiver_id]) }}" class="btn btn-success btn-sm">
                  <i class="fa fa-btn fa-envelope"></i>Отправить сообщение</a>
              </p>
              <p>
                {!! delete_to_route(['message.destroy', $message->id]) !!}
              </p>
            </div>
            <hr>
          @empty
            <p>Сообщений еще нет</p>
          @endforelse
          {!! $sentMessages->links() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
