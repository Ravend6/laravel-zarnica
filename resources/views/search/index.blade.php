@extends('layouts.app')

@section('title', 'Поиск')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Поиск</div>

        <div class="panel-body">
          <nav>
            <ul>
              <li><a href="{{ route('search.user.index') }}">Пользователей</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
