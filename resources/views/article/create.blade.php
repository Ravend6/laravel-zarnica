@extends('layouts.app')

@section('title', 'Создать новость')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Создать новость</div>

        <div class="panel-body">
          {!! Form::open([
            'method' => 'POST',
            'action' => ['ArticleController@store'],
            'files' => true])
          !!}
            @include('article._form', ['submitButton' => 'Создать'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
  <script>
    (function () {
      'use strict';

      new SimpleMDE();

    }());
  </script>
@stop
