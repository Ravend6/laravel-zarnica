@extends('layouts.app')

@section('title', 'Админка')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Админка</div>

        <div class="panel-body">
          <nav>
            <ul>
              <li><a href="{{ route('admin.article.index') }}">Новости</a></li>
              <li><a href="{{ route('admin.user.index') }}">Пользователи</a></li>
              <li><a href="{{ route('admin.role.index') }}">Роли</a></li>
              <li><a href="{{ route('admin.tag.index') }}">Теги</a></li>
              <li><a href="{{ route('admin.banned.index') }}">Баны</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
