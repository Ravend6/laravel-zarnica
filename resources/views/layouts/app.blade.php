<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'Главная') | {{ config('app.site_domain') }}</title>

  <!-- Fonts -->
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'> --}}
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

  <!-- Styles -->
  {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
  <link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/bower/animate.css/animate.min.css">
  <link rel="stylesheet" href="/bower/components-font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/bower/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
  <link rel="stylesheet" href="/bower/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="/bower/simplemde/dist/simplemde.min.css">
  {{-- <link rel="stylesheet" href="/styles/bootstrap.min.css"> --}}

  @yield('styles')

  <link rel="stylesheet" href="/styles/app.css">
  {{-- <link rel="stylesheet" href="/styles/bundle.css"> --}}

  <style>
    body {
      font-family: 'Lato';
    }

    .fa-btn {
      margin-right: 6px;
    }
  </style>
</head>
<body id="app-layout">
  @include('includes.nav')
  @yield('content')
  @include('includes.notify')
  <footer class="footer">
    <div class="container">
      <p class="pull-left"><a href="/">{{ config('app.site_name') }}</a>
        &copy; <small>2008 - {{ date('Y') }}</small></p>
        <!--<p class="pull-right"><a href="#" class="scrollup">Вверх</a></p>-->
      <p class="pull-right">Powered by <a href="mailto:ravend6@gmail.com">Ravend</a></p>
    </div>
  </footer>

  <!-- JavaScripts -->
  {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
  <script src="/bower/jquery/dist/jquery.min.js"></script>
  <script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/bower/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
  <script src="/bower/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js"></script>
  <script src="/bower/select2/dist/js/select2.full.min.js"></script>
  <script src="/bower/simplemde/dist/simplemde.min.js"></script>
  <script src="/bower/lodash/lodash.min.js"></script>
  <script src="/bower/moment/moment.js"></script>
  <script src="/bower/moment/locale/ru.js"></script>
  <script>moment.locale("ru")</script>
  <script src="/bower/jstzdetect/jstz.min.js"></script>
  <script src="/bower/socket.io-client/socket.io.js"></script>

  <script src="/scripts/lib/notify.js"></script>
  <script src="/scripts/lib/nav.js"></script>
  <script src="/scripts/frontend/app.js"></script>
  {{-- <script src="/scripts/frontend/chat.js"></script> --}}
  @yield('scripts')
  {{-- <script src="/scripts/lib/validation.js"></script> --}}
</body>
</html>
