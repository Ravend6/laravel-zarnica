@extends('layouts.app')

@section('title', 'План')

@section('content')
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">План</div>

        <div class="panel-body">
          <ul type="decimal">
            <li>* Пользователи (профайл, друзья, личные сообщения) и чат</li>
            <li>* Форум (форумы, категории, темы, ответы, рейтинги)</li>
            <li>Турниры (создание команд и турниров)</li>
          </ul>
          <p>
            <small><em>* Примечание:</em> есть вероятность того, что может быть изменена таблица пользователей и придется поновой регистрироватся.</small>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
