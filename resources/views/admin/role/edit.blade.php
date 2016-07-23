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
            'action' => ['Admin\RoleController@update', $model->id]])
          !!}
            @include('admin.role._form', ['submitButton' => 'Обновить'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
