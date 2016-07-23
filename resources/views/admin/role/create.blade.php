@extends('layouts.app')

@section('title', 'Создать роль')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Создать роль</div>

        <div class="panel-body">
          {!! Form::open([
            'method' => 'POST',
            'action' => ['Admin\RoleController@store']])
          !!}
            @include('admin.role._form', ['submitButton' => 'Создать'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
