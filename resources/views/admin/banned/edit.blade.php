@extends('layouts.app')

@section('title', 'Редактировать бан '.$model->user->name)

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Редактировать бан {{ $model->user->name }}</div>

        <div class="panel-body">
          {!! Form::model($model, [
            'method' => 'PATCH',
            'action' => ['Admin\BannedController@update', $model->id]])
          !!}
            @include('admin.banned._form', ['submitButton' => 'Обновить'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
