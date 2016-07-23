@extends('layouts.app')

@section('title', 'Чат')

@section('content')
<div class="container spark-screen">
  <div class="row">
    {{-- <div class="col-md-10 col-md-offset-1"> --}}
    <div class="col-xs-12 col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Чат
          <span class="pull-right"><i id="chat-voice" class="fa fa-bell-o"></i></span>
        </div>

        <div class="panel-body">

          <div class="chat-area">
            <div class="row">
              <div class="col-xs-8 col-md-10 messages-area">
                <ul class="messages">
                </ul>
              </div>
              <div class="col-xs-4 col-md-2">
                <p>Онлайн</p>
                <ul class="chat-users-list">
                </ul>
              </div>
            </div>
          </div>
          <br>
          <form id="form-chat-send" action="">
            <div class="input-group">
              <input type="text" class="form-control chat-input-message" autocomplete="off">
              <span class="input-group-btn">
                <img id="smiles-btn" class="btn btn-default" src="/images/chat/smiles.png" alt="smiles choice" height="34">
                <button  class="btn btn-default" type="submit">Отправить</button>
              </span>
            </div>
            <div id="smiles-choice">
              <span title="angel" class="emotions emo-angel"></span>
              <span title="confused" class="emotions emo-confused"></span>
              <span title="devil" class="emotions emo-devil"></span>
              <span title="grin" class="emotions emo-grin"></span>
              <span title="heart" class="emotions emo-heart"></span>
              <span title="kiss" class="emotions emo-kiss"></span>
              <span title="smile" class="emotions emo-smile"></span>
              <span title="sunglasses" class="emotions emo-sunglasses"></span>
              <span title="unsure" class="emotions emo-unsure"></span>
              <span title="wink" class="emotions emo-wink"></span>
              <span title="cry" class="emotions emo-cry"></span>
              <span title="frown" class="emotions emo-frown"></span>
              <span title="glasses" class="emotions emo-glasses"></span>
              <span title="grumpy" class="emotions emo-grumpy"></span>
              <span title="tongue" class="emotions emo-tongue"></span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('styles')
  {{-- <link rel="stylesheet" href="/vendor/jquery-emotions/jquery.emotions.icq.css"> --}}
  <link rel="stylesheet" href="/vendor/jquery-emotions/jquery.emotions.fb.css">
@stop

@section('scripts')
  <script src="/vendor/jquery-emotions/jquery.emotions.js"></script>
  <script>
    (function () {
      'use strict';

      var IS_VOICE = true;
      var FADE_TIME = 150; // ms
      var $window = $(window);
      var $messages = $('.messages'); // Messages area
      var $usersList = $('.chat-users-list'); // Messages area
      var $inputMessage = $('.chat-input-message'); // Input message input box
      var $voiceIco = $('#chat-voice'); // Voice
      var connected = false;
      var typing = false;
      var token = "{{ Session::getToken() }}";
      // var usersList = [];
      var currentUser = {
        userId: {{ Auth::user()->id }},
        username: '{{ Auth::user()->name }}',
      }

      var socket = io('http://89.252.49.108:3000', {
        transports: ['websocket']
      });

      socket.on('connect', function () {
        // console.log('socket connect ' + '{{ Auth::user()->name }}');
      });

      socket.emit('add user', currentUser);

      $('#form-chat-send').submit(function () {
        $inputMessage.focus();

        if ($inputMessage.val() == '') return false;

        socket.emit('new message', $inputMessage.val());

        var newMessageObject = _.extend(currentUser, {
          message: $inputMessage.val(),
          datetime: moment().format('H:mm:ss')
          // datetime: "{{ date('H:i:s') }}" jstz.determine().name()
          // datetime: "{{ Carbon\Carbon::now()->timezone('Europe/Kiev')->format('H:i:s') }}"
          // datetime: moment().format('H:mm:ss')

        });

        addMessage(newMessageObject);

        $inputMessage.val('');

        // $('.chat-txt').emotions(); // smiles render

        return false;
      });

      socket.on('new message', function (data) {
        addMessage(_.extend(data, {
          datetime: moment().format('H:mm:ss')
        }));
        // Audio
        if (IS_VOICE) {
          var audio = new Audio();
          audio.src = '/audio/chat/message.mp3';
          audio.autoplay = true;
        }
      });

      socket.on('user joined', function (data) {
        // $usersList.append($('<li>').text(data.username));
        // usersList.push(data);
        renderUsers(data.allUsers);
        // console.log('user joined', data);
        $('.chat-user-banned').on('click', function (e) {
          e.preventDefault();
          var bannedUserId = $(this).data('userId');
          console.log(bannedUserId);
          $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            data: {
              // _method: 'delete',
              _token: token
            },
          }).done(function (data, status, req) {
            socket.emit('user banned', bannedUserId);
            addLogBanned(_.extend({}, {
              username: data.name,
              datetime: moment().format('H:mm:ss')
            }));
          }).fail(function (err) {
            // console.log(err);
          });
        });
      });

      socket.on('user joined log', function (data) {
        addLogEnter(_.extend(data, {
          datetime: moment().format('H:mm:ss')
        }));

        // Audio
        if (IS_VOICE) {
          var audio = new Audio();
          audio.src = '/audio/chat/owl.mp3';
          audio.autoplay = true;
        }
      });

      socket.on('user left', function (data) {
        renderUsers(data.allUsers);
        addLogLeave(_.extend(data, {
          datetime: moment().format('H:mm:ss')
        }));
        // console.log('user left', data);
      });

      socket.on('user banned', function (data) {

        if (socket.io.engine.id == data.id) {
          window.location.href = '/';
        }

        // Audio
        if (IS_VOICE) {
          var audio = new Audio();
          audio.src = '/audio/chat/thunder.mp3';
          audio.autoplay = true;
        }

        addLogBanned(_.extend(data, {
          datetime: moment().format('H:mm:ss')
        }));
        // console.log('user left', data);
      });

      function addMessage(data) {
        $messages.append($('<li class="chat-txt">')
          .text(data.datetime + ' ' + data.username + ': ' + data.message));
        $('.chat-txt').emotions(); // smiles render
        $messages[0].scrollTop = $messages[0].scrollHeight;
      }

      function addLogEnter(data) {
        $messages.append($('<li>').html(
          $('<em>').text(data.datetime + ' ' + data.username + ', вошел в чат')
        ));
        $messages[0].scrollTop = $messages[0].scrollHeight;
      }

      function addLogLeave(data) {
        $messages.append($('<li>').html(
          $('<em>').text(data.datetime + ' ' + data.username + ', покидает чат')
        ));
        $messages[0].scrollTop = $messages[0].scrollHeight;
      }

      function addLogBanned(data) {
        $messages.append($('<li>').html(
          $('<em>').text(data.datetime + ' ' + data.username + ', забанен')
        ));
        $messages[0].scrollTop = $messages[0].scrollHeight;
      }

      function renderUsers(usersList) {
        $usersList.html('');

        usersList.forEach(function (user, index) {
          @can('isAdmin', Auth::user())
            if (currentUser.userId != user.userId) {
              var $bannedLink = $('<a>', {
                href: '/banned/chat/' + user.userId,
                'data-user-id': user.userId,
                html: ' <i class="fa fa-ban"></i>',
                class: 'chat-user-banned',
                // onclick: "return confirm('Вы точно хотите забанить?')"
              });
            }
          @endcan
          $usersList.append($('<li>').html(
            [
              $('<a>', {
                href: '/profile/' + user.userId,
                target: '_blank',
                text: user.username
              }),
              @can('isAdmin', Auth::user())
                $bannedLink
              @endcan
            ]
          ));
        });
      }

      // Voice
      $voiceIco.on('click', function (e) {
        if ($voiceIco.attr('class') == 'fa fa-bell-o') {
          IS_VOICE = false;
          $voiceIco.removeClass('fa-bell-o');
          $voiceIco.addClass('fa-bell-slash-o');
        } else {
          IS_VOICE = true;
          $voiceIco.removeClass('fa-bell-slash-o');
          $voiceIco.addClass('fa-bell-o');
        }
      });

      // Smile choice
      var $smiles = $("#smiles-choice");
      var $smilesBtn = $("#smiles-btn");

      $('#smiles-choice').emotions(); // smiles render

      $("#smiles-choice span").click(function () {
        var shortCode = $.emotions.shortcode($(this).attr("title"));
        $inputMessage.val($inputMessage.val() + " " + shortCode + " ");
        // $smiles.toggle();
        $inputMessage.focus();
      });

      $smilesBtn.click(function () {
        $smiles.toggle();
      });

      // $inputMessage.keydown(function (e) {
      //   console.log(11);
      //   $inputMessage.emotions();
      // }).focus();

      // function chatUserBanned() {
      //   console.log('banned');
      //   return false;
      // }

    }());
  </script>
@stop
