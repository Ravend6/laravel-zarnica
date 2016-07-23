<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Api</title>
    <script>var baseUrl = '{{ url('/') }}/';</script>
</head>
<body>
    <h1>Api</h1>
    <button id="auth">Auth</button>
    <button id="show-name">Show My Name</button>
    <div id="content"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        (function() {
            'use strict';
            $('#auth').click(function (e) {
                $.ajax({
                    url: '/api/authenticate',
                    method: 'post',
                    data: {
                        // _method: 'delete',
                        // _token: $(this).data('csrf')
                        'email': 'test@email.com',
                        'password': 'qwerty',
                    }
                }).done(function (data, status, req) {
                    localStorage.setItem('_token', data.token);
                }).fail(function (err) {
                    console.log(err);
                });
            });
            $('#show-name').click(function (e) {
                $.ajax({
                    url: '/api/user/name?token=' + localStorage.getItem('_token'),
                    method: 'get'
                }).done(function (data, status, req) {
                    document.getElementById('content').innerHTML = data.user.name;
                }).fail(function (err) {
                    console.log(err);
                });
            });
            // $('#show-name').click(function (e) {
            //     $.ajax({
            //         url: '/api/authenticate',
            //         method: 'post',
            //         data: {
            //             // _method: 'delete',
            //             // _token: $(this).data('csrf')
            //             'email': 'test@email.com',
            //             'password': 'qwerty',
            //         }
            //     }).done(function (data, status, req) {
            //         var token = data.token;
            //         console.log(token);
            //         $.ajax({
            //             url: '/api/user/name?token=' + token,
            //             method: 'get',
            //         }).done(function (data, status, req) {
            //             var name = data.name;
            //             document.getElementById('content').innerHTML = name;
            //         }).fail(function (err) {
            //             console.log(err);
            //         });
            //     }).fail(function (err) {
            //         console.log(err);
            //     });
            // })
        }());
    </script>
</body>
</html>
