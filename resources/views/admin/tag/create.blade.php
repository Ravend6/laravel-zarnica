@extends('layouts.app')

@section('title', 'Создать тег')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Создать тег</div>

        <div class="panel-body">
          {!! Form::open([
            'method' => 'POST',
            'action' => ['Admin\TagController@store']])
          !!}
            @include('admin.tag._form', ['submitButton' => 'Создать'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
