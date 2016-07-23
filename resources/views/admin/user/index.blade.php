@extends('layouts.app')

@section('title', 'Пользователи')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">
          Поиск
          <span class="pull-right">
            <img class="search-fade" src="/images/forums/fade/in.png"
            alt="fade forums ico" data-id="toggle-area">
          </span>
        </div>

        <div class="panel-body" id="toggle-area">
          {!! Form::model($model, [
            'method' => 'POST',
            'action' => ['Admin\UserController@postSearch']
          ]) !!}
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Имя:', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('name'))
              <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            @if ($errors->has('email'))
              <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('role_list') ? ' has-error' : '' }}">
            {!! Form::label('role_list', 'Роль:', ['class' => 'control-label']) !!}
            {!! Form::select('role_list', $roles, null, ['class' => 'form-control']) !!}
            @if ($errors->has('role_list'))
              <span class="help-block">{{ $errors->first('role_list') }}</span>
            @endif
          </div>
          <div class="form-group">
            {!! Form::submit('Поиск', ['class' => 'btn btn-primary']) !!}
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>

    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Пользователи</div>

        <div class="panel-body">

          <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#Id</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Аватар</th>
                <th>Роли</th>
                <th>Редактировать</th>
                <th>Удалить</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($models as $model)
                <tr>
                  <td>{{ $model->id }}</td>
                  <td><a href="/profile/{{ $model->id }}">{{ $model->name }}</a></td>
                  <td>{{ $model->email }}</td>
                  <td>
                    @if ($model->avatar)
                      <img src="/uploads/users/avatars/{{ $model->id }}/{{ $model->avatar }}"
                        alt="{{ $model->name }} avatar" class="thumbnail" width="40">
                    @else
                      <img src="/images/users/avatars/noavatar.png"
                        alt="{{ $model->name }} avatar" class="thumbnail" width="40">
                    @endif
                  </td>
                  <td>
                      {{-- Роли: --}}
                      <?php $profileRoles = ''; ?>
                      @foreach ($model->roles as $role)
                        <?php $profileRoles .=  $role->name.', ' ?>
                      @endforeach
                      {{ mb_substr($profileRoles, 0, mb_strlen($profileRoles) - 2) }}
                  </td>
                  <td>{!! edit_to_route('admin.user.edit', [$model->id]) !!}</td>
                  <td>{!! delete_to_route(['admin.user.destroy', $model->id]) !!}</td>
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

@section('scripts')
  <script>
    (function () {
      'use strict';

      // свернуть и развернуть поиск
      $('.search-fade').click(function () {
        var id = $(this).data('id');
        if ($(this).attr('src') === '/images/search/fade/out.png') {
          $(this).attr('src', '/images/search/fade/in.png');
        } else {
          $(this).attr('src', '/images/search/fade/out.png');
        }
        $('#' + id).slideToggle('fast');
        // $('#' + id).fadeToggle(400);
      });

    }());
  </script>
@stop
