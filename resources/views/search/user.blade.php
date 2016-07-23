@extends('layouts.app')

@section('title', 'Поиск пользователей')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Поиск пользователей</div>

        <div class="panel-body">
          @if (session()->has('result'))
            {{ session('result') }}
          @endif
          {!! Form::open([
            'method' => 'POST',
            'action' => ['SearchController@postUser']
          ]) !!}
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Имя:', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('name'))
              <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            @if ($errors->has('email'))
              <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
            {!! Form::label('sex', 'Пол:', ['class' => 'control-label']) !!}
            {!! Form::select('sex', $sex_list,
              null, ['class' => 'form-control']) !!}
            @if ($errors->has('sex'))
              <span class="help-block">{{ $errors->first('sex') }}</span>
            @endif
          </div>
          <div class="form-group">
            {!! Form::submit('Поиск', ['class' => 'btn btn-primary']) !!}
          </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  @if (session()->has('users'))
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Результат</div>

          <div class="panel-body">
            <ul>
              @forelse (session('users') as $user)
                <li><a href="/profile/{{ $user->id }}">{{ $user->name }}</a></li>
              @empty
                <li>Ничего не найдено</li>
              @endforelse
            </ul>
          </div>
        </div>
      </div>
    </div>
  @endif

</div>
@stop
