@extends('layouts.app')

@section('title', 'Редактировать '.$model->name)

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Редактировать {{ $model->name }}</div>

        <div class="panel-body">
          {!! Form::model($model, [
            'method' => 'PATCH',
            'action' => ['Admin\UserController@update', $model->id]])
          !!}
            @include('admin.user._form', ['submitButton' => 'Обновить'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    @if ($model->avatar)
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Аватар {{ $model->name }}</div>

          <div class="panel-body">
            <img src="/uploads/users/avatars/{{ $model->id }}/{{ $model->avatar }}"
            alt="{{ $model->name }} avatar" class="thumbnail" width="200">
            <p></p>
            {!! delete_to_route(['admin.user.avatar.destroy', $model->id], 'Удалить аватар') !!}
          </div>
        </div>
      </div>
    @endif
  </div>
</div>
@stop
