@extends('layouts.app')

@section('title', 'Роли')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Роли</div>

        <div class="panel-body">
          <p>
            <a href="{{ route('admin.role.create') }}" class="btn btn-success">
              <i class="fa fa-btn fa-plus-circle"></i>Создать роль</a>
          </p>
          <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#Id</th>
                <th>Имя</th>
                <th>Редактировать</th>
                <th>Удалить</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($models as $model)
                <tr>
                  <td>{{ $model->id }}</td>
                  <td>{{ $model->name }}</td>
                  <td>{!! edit_to_route('admin.role.edit', [$model->id]) !!}</td>
                  <td>{!! delete_to_route(['admin.role.destroy', $model->id]) !!}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
          {!! $models->links() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
