@extends('layouts.app')

@section('title', 'Изменить пароль')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Изменить пароль</div>

        <div class="panel-body">
          @include('profile._tabs', ['activeClass' => 'profile.password.edit'])
          <p></p>
          {!! Form::model($model, [
            'method' => 'PATCH',
            'action' => ['ProfileController@passwordUpdate', $model->id]
          ]) !!}
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'Текущий пароль:', ['class' => 'control-label']) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            @if ($errors->has('password'))
              <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
            {!! Form::label('new_password', 'Новый пароль:', ['class' => 'control-label']) !!}
            {!! Form::password('new_password', ['class' => 'form-control']) !!}
            @if ($errors->has('new_password'))
              <span class="help-block">{{ $errors->first('new_password') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
            {!! Form::label('new_password_confirmation', 'Подтвердите новый пароль:', ['class' => 'control-label']) !!}
            {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
            @if ($errors->has('new_password_confirmation'))
              <span class="help-block">{{ $errors->first('new_password_confirmation') }}</span>
            @endif
          </div>
          <div class="form-group">
            {!! Form::submit('Обновить', ['class' => 'btn btn-primary']) !!}
          </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
