@extends('layouts.app')

@section('title', 'Новости')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Новости</div>

        <div class="panel-body">
          <p>
            <a href="{{ route('article.create') }}" class="btn btn-success">
              <i class="fa fa-btn fa-plus-circle"></i>Создать новость</a>
          </p>
          <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#Id</th>
                <th>Заглавие</th>
                <th>Автор</th>
                <th>Опубликовано</th>
                <th>Прикреплено</th>
                <th>Закрыто</th>
                <th>Редактировать</th>
                <th>Удалить</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($models as $model)
              <tr {{ $model->is_visible ? '' : 'class=warning'}}>
                <td>{{ $model->id }}</td>
                <td><a href="{{ route('article.show', [$model->slug]) }}">{{ $model->title }}</a></td>
                <td><a href="{{ route('profile.show', [$model->user_id]) }}">{{ $model->user->name }}</a></td>
                <td>{{ $model->is_visible ? 'Да' : 'Нет' }}</td>
                <td>{{ $model->is_sticky ? 'Да' : 'Нет' }}</td>
                <td>{{ $model->is_closed ? 'Да' : 'Нет' }}</td>
                <td>{!! edit_to_route('article.edit', [$model->slug]) !!}</td>
                <td>
                  @if (is_admin_role(Auth::user()))
                    {!! delete_to_route(['admin.article.destroy', $model->slug]) !!}
                  @else
                    <button class="btn btn-danger btn-sm" disabled><i class="fa fa-btn fa-trash-o"></i>Удалить</button>
                  @endif
                </td>
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
