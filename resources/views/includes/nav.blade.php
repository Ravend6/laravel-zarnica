<?php
if (Auth::check()) {
  $friendNotConfirmCount = App\Friend::notconfirm(Auth::user()->id)->count();
  $messagesCount = App\Message::where('receiver_id', Auth::user()->id)
    ->where('type', false)
    ->where('is_read', false)
    ->count();
}
?>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">

      <!-- Collapsed Hamburger -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <!-- Branding Image -->
      <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.site_name') }}
      </a>
    </div>

    <div class="collapse navbar-collapse" id="spark-navbar-collapse">
      <!-- Left Side Of Navbar -->
      <ul class="nav navbar-nav">
        @can('showAdminpanel', \Auth::user())
          <li><a href="{{ url('/admin') }}">Админ</a></li>
        @endcan
        <li><a href="{{ url('/chat') }}">Чат</a></li>
        <li><a href="{{ url('/search') }}">Поиск</a></li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
        <li><a href="{{ url('/login') }}">Вход</a></li>
        <li><a href="{{ url('/register') }}">Регистрация</a></li>
        @else
          {{-- @if (App\Friend::notconfirm(Auth::user()->id)->count())
            <li><a href="{{ url('/friend/confirm') }}">Подтвердить друзей
              <span class="badge">{{ App\Friend::notconfirm(Auth::user()->id)->count() }}</span></a></li>
          @endif --}}
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->name }}
            @if ($friendNotConfirmCount and $messagesCount)
              <span class="badge nav-badge-danger">{{ $friendNotConfirmCount + $messagesCount }}</span>
            @else
              @if ($friendNotConfirmCount)
                <span class="badge nav-badge-danger">{{ $friendNotConfirmCount }}</span>
              @elseif ($messagesCount)
                <span class="badge nav-badge-danger">{{ $messagesCount }}</span>
              @endif
            @endif
            {{-- @if ($friendNotConfirmCount)<span class="badge nav-badge-danger">{{ $friendNotConfirmCount }}</span>@endif
            @if ($messagesCount)<span class="badge nav-badge-danger">{{ $messagesCount }}</span>@endif --}}
            <span class="caret"></span>
          </a>

          <ul class="dropdown-menu" role="menu">
            @can('createArticle', Auth::user())
            <li><a href="{{ route('article.index') }}"><i class="fa fa-btn fa-file-text"></i>Новости</a></li>
            @endcan
            <li><a href="{{ url('/message') }}"><i class="fa fa-btn fa-envelope"></i>Сообщения
              @if ($messagesCount)<span class="badge nav-badge-danger">{{ $messagesCount }}</span>@endif
            </a></li>
            <li><a href="{{ url('/profile/friends') }}"><i class="fa fa-btn fa-users"></i>Мои друзья
              @if ($friendNotConfirmCount)<span class="badge nav-badge-danger">{{ $friendNotConfirmCount }}</span>@endif
            </a></li>
            <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Профайл</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Выйти</a></li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
