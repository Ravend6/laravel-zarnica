@extends('layouts.app')

@section('title', 'Профайл')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{ Auth::user()->name }} профайл</div>

        <div class="panel-body">
          @include('profile._tabs', ['activeClass' => 'profile.index'])
          <p></p>
          @if (Auth::user()->avatar)
            <img src="/uploads/users/avatars/{{ Auth::user()->id }}/{{ Auth::user()->avatar }}"
              alt="{{ Auth::user()->name }} avatar" class="thumbnail" width="200">
          @else
            <img src="/images/users/avatars/noavatar.png"
              alt="{{ Auth::user()->name }} avatar" class="thumbnail" width="200">
          @endif
          <p>Имя: <a href="{{ route('profile.show', [Auth::user()->id]) }}">{{ Auth::user()->name }}</a></p>
          <p>Email: {{ Auth::user()->email }}</p>
          <p>
            @unless (Auth::user()->sex)
              Пол: неизвестный
            @endunless
            @if (Auth::user()->sex == 1)
              Пол: мужской
            @elseif(Auth::user()->sex == 2)
              Пол: женский
            @endif
          </p>
          @if (Auth::user()->status == 'active')
          <p>Статус аккаунта: <span class="label label-success">{{ Auth::user()->status }}</span></p>
          @endif
          @if (Auth::user()->status == 'deleted' or Auth::user()->status == 'banned')
            <p>Статус аккаунта: <span class="label label-danger">{{ Auth::user()->status }}</span></p>
          @endif
          {{-- Роли: --}}
          <?php $userRoles = 'Роли: '; ?>
          @foreach (Auth::user()->roles as $role)
            <?php $userRoles .=  $role->name.', ' ?>
          @endforeach
          {{ mb_substr($userRoles, 0, mb_strlen($userRoles) - 2) }}
          <p>Карма: {{ Auth::user()->karma }}</p>
          <p>Ваш статус: {{ Auth::user()->user_status ?: 'Нет' }}</p>
          <p>Подпись: {{ Auth::user()->caption ?: 'Нет' }}</p>
          @if (Auth::user()->birthday == '0000-00-00' or !Auth::user()->birthday)
            <p>Дата рождения: Нет</p>
          @else
            <p>Дата рождения: {{ Auth::user()->birthday }}</p>
          @endif
          <p>Skype: {{ Auth::user()->skype ?: 'Нет' }}</p>
          <p>ICQ: {{ Auth::user()->icq ?: 'Нет' }}</p>
          <p>Зарегистрировался: {{ Auth::user()->created_at->diffForHumans() }}</p>
          <a href="{{ route('profile.edit', [Auth::user()->id]) }}"
            class="btn btn-primary btn-sm"><i class="fa fa-btn fa-pencil-square-o"></i>Редактировать</a>
          <p></p>
          @can('removeAccount', Auth::user())
            {!! delete_to_route(['profile.destroy', Auth::user()->id], 'Удалить аккаунт') !!}
          @else
            <a href="{{ route('profile.account.activate') }}" class="btn btn-info btn-sm">
              <i class="fa fa-btn fa-cog"></i>Активировать аккант</a>
          @endcan
        </div>
      </div>
    </div>
  </div>
</div>
@stop
