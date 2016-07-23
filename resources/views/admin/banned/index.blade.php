@extends('layouts.app')

@section('title', 'Банны')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Банны</div>

        <div class="panel-body">
{{--           <p>
            <a href="{{ route('article.create') }}" class="btn btn-success">
              <i class="fa fa-btn fa-plus-circle"></i>Создать новость</a>
          </p> --}}
          <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#Id</th>
                <th>Имя админа</th>
                <th>Имя забаненого</th>
                <th>Дата бана</th>
                <th>Дата разбана</th>
                <th>Редактировать</th>
                <th>Удалить</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($models as $model)
              <tr {{ $model->isBanned() ? 'class=warning' : ''}}>
                <td>{{ $model->id }}</td>
                <td>{{ $model->adminUser->name }}</td>
                <td>{{ $model->user->name }}</td>
                <td>{{ $model->created_at}}</td>
                <td>{{ $model->ended_at }}</td>
                <td>{!! edit_to_route('admin.banned.edit', [$model->id]) !!}</td>
                <td>{!! delete_to_route(['admin.banned.destroy', $model->id]) !!}</td>
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