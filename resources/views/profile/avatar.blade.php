@extends('layouts.app')

@section('title', 'Изменить аватар')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{ Auth::user()->name }} профайл</div>

        <div class="panel-body">
          @include('profile._tabs', ['activeClass' => 'profile.avatar.create'])
          <p></p>
          {!! Form::open([
            'method' => 'POST',
            'action' => ['ProfileController@avatarStore'],
            'files' => true,
          ]) !!}

          <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
            {!! Form::label('avatar', 'Аватар:', ['class' => 'control-label']) !!}
            {!! Form::file('avatar', null, ['class' => 'form-control']) !!}
            @if ($errors->has('avatar'))
              <span class="help-block">{{ $errors->first('avatar') }}</span>
            @endif
          </div>

          <div class="form-group">
            {!! Form::submit('Загрузить', ['class' => 'btn btn-primary btn-sm']) !!}
          </div>

          {!! Form::close() !!}

          @if (Auth::user()->avatar)
            <img src="/uploads/users/avatars/{{ Auth::user()->id }}/{{ Auth::user()->avatar }}"
              alt="{{ Auth::user()->name }} avatar" class="thumbnail" width="200">
            <p></p>
            {!! delete_to_route(['profile.avatar.destroy', Auth::user()->id], 'Удалить аватар') !!}
          @else
            <img src="/images/users/avatars/noavatar.png"
              alt="{{ Auth::user()->name }} avatar" class="thumbnail" width="200">
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@stop
