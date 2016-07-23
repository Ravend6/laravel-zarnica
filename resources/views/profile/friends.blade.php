@extends('layouts.app')

@section('title', 'Мои друзья')

@section('content')
@include('friend.confirm')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Мои друзья</div>
        <div class="panel-body">

          <div class="row">
            @forelse (App\Friend::confirm(Auth::user()->id) as $friend)
              <div class="col-sm-4 col-md-4 col-xs-4">
                <div class="thumbnail">
                  @if ($friend->user->avatar)
                    <img src="/uploads/users/avatars/{{ $friend->user->id }}/{{ $friend->user->avatar }}"
                      alt="{{ $friend->user->name }} avatar" style="height: 240px; width: 100%; display: block;">
                  @else
                    <img src="/images/users/avatars/noavatar.png"
                      alt="{{ $friend->user->name }} avatar" style="height: 240px; width: 100%; display: block;">
                  @endif
                  <div class="caption text-center">
                    <div>
                      <a href="{{ route('profile.show', [$friend->user->id]) }}">{{ $friend->user->name }}</a>
                    </div>
                    <p></p>
                    @can('sendMessage', $friend->user)
                      <a href="{{ route('message.send', [$friend->user->id]) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-btn fa-envelope"></i>Отправить сообщение</a>
                    @endcan
                    <p></p>
                    @can('removeFriend', $friend->user)
                      <a href="{{ route('friend.remove', [$friend->user->id]) }}"
                        onclick="return confirm('Вы уверены?')" class="btn btn-danger btn-sm"><i class="fa fa-user-times"></i>
                        Убрать из друзей</a>
                    @endcan
                  </div>
                </div>
              </div>
            @empty
              <div class="text-center">Друзей еще нет</div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
