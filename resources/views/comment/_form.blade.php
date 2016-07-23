<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
  {!! Form::label('body', 'Текст:', ['class' => 'control-label']) !!}
  {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
  @if ($errors->has('body'))
    <span class="help-block">{{ $errors->first('body') }}</span>
  @endif
</div>
<div class="form-group">
  {!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!}
</div>
