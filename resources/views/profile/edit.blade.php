@extends('layouts.app')

@section('title', 'Изменить профайл')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{ Auth::user()->name }} профайл</div>

        <div class="panel-body">
          @include('profile._tabs', ['activeClass' => 'profile.edit'])
          <p></p>
          {!! Form::model($model, [
            'method' => 'PATCH',
            'action' => ['ProfileController@update', $model->id]
          ]) !!}
          <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
            {!! Form::label('sex', 'Пол:', ['class' => 'control-label']) !!}
            {!! Form::select('sex', $sex_list,
              null, ['class' => 'form-control']) !!}
            @if ($errors->has('sex'))
              <span class="help-block">{{ $errors->first('sex') }}</span>
            @endif
          </div>
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
          <div class="form-group{{ $errors->has('user_status') ? ' has-error' : '' }}">
            {!! Form::label('user_status', 'Ваш статус:', ['class' => 'control-label']) !!}
            {!! Form::textarea('user_status', null, ['class' => 'form-control']) !!}
            @if ($errors->has('user_status'))
              <span class="help-block">{{ $errors->first('user_status') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
            {!! Form::label('caption', 'Подпись:', ['class' => 'control-label']) !!}
            {!! Form::textarea('caption', null, ['class' => 'form-control']) !!}
            @if ($errors->has('caption'))
              <span class="help-block">{{ $errors->first('caption') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
            {!! Form::label('birthday', 'Дата рождения:', ['class' => 'control-label']) !!}
            {!! Form::date('birthday', null, ['class' => 'form-control']) !!}
            @if ($errors->has('birthday'))
              <span class="help-block">{{ $errors->first('birthday') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('skype') ? ' has-error' : '' }}">
            {!! Form::label('skype', 'Skype:', ['class' => 'control-label']) !!}
            {!! Form::text('skype', null, ['class' => 'form-control']) !!}
            @if ($errors->has('skype'))
              <span class="help-block">{{ $errors->first('skype') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('icq') ? ' has-error' : '' }}">
            {!! Form::label('icq', 'ICQ:', ['class' => 'control-label']) !!}
            {!! Form::text('icq', null, ['class' => 'form-control']) !!}
            @if ($errors->has('icq'))
              <span class="help-block">{{ $errors->first('icq') }}</span>
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
