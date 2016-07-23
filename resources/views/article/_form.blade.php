<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
  {!! Form::label('title', 'Заглавие:', ['class' => 'control-label']) !!}
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
  @if ($errors->has('title'))
  <span class="help-block">{{ $errors->first('title') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('tag_list') ? ' has-error' : '' }}">
  {!! Form::label('tag_list', 'Теги:', ['class' => 'control-label']) !!}
  {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control', 'multiple']) !!}
  @if ($errors->has('tag_list'))
    <span class="help-block">{{ $errors->first('tag_list') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
  {!! Form::label('image', 'Картинка:', ['class' => 'control-label']) !!}
  {!! Form::file('image', ['class' => 'form-control']) !!}
  @if ($errors->has('image'))
    <span class="help-block">{{ $errors->first('image') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
  {!! Form::label('body', 'Текст:', ['class' => 'control-label']) !!}
  {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
  @if ($errors->has('body'))
    <span class="help-block">{{ $errors->first('body') }}</span>
  @endif
</div>
@if (is_admin_role(Auth::user()))
  <div class="form-group{{ $errors->has('is_visible') ? ' has-error' : '' }}">
    {!! Form::label('is_visible', 'Опубликовано:', ['class' => 'control-label']) !!}
    {!! Form::select('is_visible', $is_visible, null, ['class' => 'form-control']) !!}
    @if ($errors->has('is_visible'))
      <span class="help-block">{{ $errors->first('is_visible') }}</span>
    @endif
  </div>
  <div class="form-group{{ $errors->has('is_sticky') ? ' has-error' : '' }}">
    {!! Form::label('is_sticky', 'Прикреплено:', ['class' => 'control-label']) !!}
    {!! Form::select('is_sticky', $is_sticky, null, ['class' => 'form-control']) !!}
    @if ($errors->has('is_sticky'))
      <span class="help-block">{{ $errors->first('is_sticky') }}</span>
    @endif
  </div>
  <div class="form-group{{ $errors->has('is_closed') ? ' has-error' : '' }}">
    {!! Form::label('is_closed', 'Закрыто:', ['class' => 'control-label']) !!}
    {!! Form::select('is_closed', $is_closed, null, ['class' => 'form-control']) !!}
    @if ($errors->has('is_closed'))
      <span class="help-block">{{ $errors->first('is_closed') }}</span>
    @endif
  </div>
@endif
<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
  {!! Form::label('user_id', 'Автор:', ['class' => 'control-label']) !!}
  {!! Form::select('user_id', isset($users) ? $users : [Auth::user()->id => Auth::user()->name],
    null, ['class' => 'form-control', is_admin_role(Auth::user()) ? '' : 'readonly'])
  !!}
  @if ($errors->has('user_id'))
    <span class="help-block">{{ $errors->first('user_id') }}</span>
  @endif
</div>
<div class="form-group">
  {!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!}
</div>
