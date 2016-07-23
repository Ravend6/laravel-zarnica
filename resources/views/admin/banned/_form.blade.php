
<div class="form-group{{ $errors->has('ended_at') ? ' has-error' : '' }}">
  {!! Form::label('ended_at', 'Конец бана:', ['class' => 'control-label']) !!}
  {!! Form::datetime('ended_at', null, ['class' => 'form-control']) !!}
  @if ($errors->has('ended_at'))
    <span class="help-block">{{ $errors->first('ended_at') }}</span>
  @endif
</div>

<div class="form-group">
  {!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!}
</div>
