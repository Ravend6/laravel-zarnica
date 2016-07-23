@extends('layouts.app')

@section('title', $profile->name)

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-6 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{ $profile->name }}</div>

        <div class="panel-body">
          <p style="margin-top: 20px;"></p>
          @if ($profile->avatar)
            <img src="/uploads/users/avatars/{{ $profile->id }}/{{ $profile->avatar }}"
              alt="{{ $profile->name }} avatar" class="thumbnail" width="200">
          @else
            <img src="/images/users/avatars/noavatar.png"
              alt="{{ $profile->name }} avatar" class="thumbnail" width="200">
          @endif
          <p>Имя: {{ $profile->name }}</p>
          <p>Email: {{ $profile->email }}</p>
          <p>
            @unless ($profile->sex)
              Пол: неизвестный
            @endunless
            @if ($profile->sex == 1)
              Пол: мужской
            @elseif($profile->sex == 2)
              Пол: женский
            @endif
          </p>
          @if ($profile->status == 'active')
          <p>Статус аккаунта: <span class="label label-success">{{ $profile->status }}</span></p>
          @endif
          @if ($profile->status == 'deleted' or $profile->status == 'banned')
            <p>Статус аккаунта: <span class="label label-danger">{{ $profile->status }}</span></p>
          @endif
          <p>
            {{-- Роли: --}}
            <?php $profileRoles = 'Роли: '; ?>
            @foreach ($profile->roles as $role)
              <?php $profileRoles .=  $role->name.', ' ?>
            @endforeach
            {{ mb_substr($profileRoles, 0, mb_strlen($profileRoles) - 2) }}
          </p>
          <p>Карма: {{ $profile->karma }}</p>
          <p>Ваш статус: {{ $profile->user_status ?: 'Нет' }}</p>
          <p>Подпись: {{ $profile->caption ?: 'Нет' }}</p>
          @if ($profile->birthday == '0000-00-00' or !$profile->birthday)
            <p>Дата рождения: Нет</p>
          @else
            <p>Дата рождения: {{ $profile->birthday }}</p>
          @endif
          <p>Skype: {{ $profile->skype ?: 'Нет' }}</p>
          <p>ICQ: {{ $profile->icq ?: 'Нет' }}</p>
          <p>Зарегистрировался: {{ $profile->created_at->diffForHumans() }}</p>
          <p></p>
          @can('sendMessage', $profile)
            <a href="{{ route('message.send', [$profile->id]) }}" class="btn btn-success btn-sm">
              <i class="fa fa-btn fa-envelope"></i>Отправить сообщение</a>
          @endcan
          <p></p>
          @can('addFriend', $profile)
            <a href="{{ route('friend.add', [$profile->id]) }}"
              onclick="return confirm('Вы уверены?')" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i>
              Добавить в друзья</a>
          @endcan
          @can('removeFriend', $profile)
            <a href="{{ route('friend.remove', [$profile->id]) }}"
              onclick="return confirm('Вы уверены?')" class="btn btn-danger btn-sm"><i class="fa fa-user-times"></i>
              Убрать из друзей</a>
          @endcan
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Друзья {{ $profile->name }}</div>

        <div class="panel-body">
          <div class="row">
            @forelse (App\Friend::confirm($profile->id) as $friend)
              <p style="margin-top: 20px;"></p>
              <div class="col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
                <div class="thumbnail">
                  @if ($friend->user->avatar)
                    <img src="/uploads/users/avatars/{{ $friend->user->id }}/{{ $friend->user->avatar }}"
                      alt="{{ $friend->user->name }} avatar" style="height: 180px; width: 100%; display: block;">
                  @else
                    <img src="/images/users/avatars/noavatar.png"
                      alt="{{ $friend->user->name }} avatar" style="height: 180px; width: 100%; display: block;">
                  @endif
                  <div class="caption text-center">
                    <div>
                      <a href="{{ route('profile.show', [$friend->user->id]) }}">{{ $friend->user->name }}</a>
                    </div>
                    @can('sendMessage', $friend->user)
                      <p></p>
                      <a href="{{ route('message.send', [$friend->user->id]) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-btn fa-envelope"></i>Отправить сообщение</a>
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
