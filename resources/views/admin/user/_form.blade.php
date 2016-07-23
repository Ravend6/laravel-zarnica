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
<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
  {!! Form::label('password', 'Пароль:', ['class' => 'control-label']) !!}
  {!! Form::password('password', ['class' => 'form-control']) !!}
  @if ($errors->has('password'))
    <span class="help-block">{{ $errors->first('password') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
  {!! Form::label('password_confirmation', 'Подтвердите пароль:', ['class' => 'control-label']) !!}
  {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
  @if ($errors->has('password_confirmation'))
    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('role_list') ? ' has-error' : '' }}">
  {!! Form::label('role_list', 'Роль:', ['class' => 'control-label']) !!}
  {!! Form::select('role_list[]', $roles, null, ['class' => 'form-control', 'multiple']) !!}
  @if ($errors->has('role_list'))
    <span class="help-block">{{ $errors->first('role_list') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('karma') ? ' has-error' : '' }}">
  {!! Form::label('karma', 'Карма:', ['class' => 'control-label']) !!}
  {!! Form::number('karma', null, ['class' => 'form-control']) !!}
  @if ($errors->has('karma'))
    <span class="help-block">{{ $errors->first('karma') }}</span>
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
  {!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!}
</div>
