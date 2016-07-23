var http = require('http').Server();
var io = require('socket.io')(http);
var _ = require('lodash');

// var request = require('request');



var m = new Map();
// Chatroom

var numUsers = 0;

io.on('connection', function (socket) {
  var addedUser = false;

  // when the client emits 'new message', this listens and executes
  socket.on('new message', function (data) {
    // we tell the client to execute 'new message'
    socket.broadcast.emit('new message', {
      username: socket.username,
      id: socket.id,
      message: data
    });
  });

  // when the client emits 'add user', this listens and executes
  socket.on('add user', function (user) {
    console.log('add user:', user.username);

    if (addedUser) return;

    // we store the username in the socket session for this client
    socket.username = user.username;
    socket.userId = user.userId;

    ++numUsers;
    addedUser = true;
    m.set(user.userId, _.extend(user, {id: socket.id}));
    console.log('mapToArray add', mapToArray(m));
    // socket.emit('login', {
    //   numUsers: numUsers
    // });
    // echo globally (all clients) that a person has connected
    socket.broadcast.emit('user joined log', {
      id: socket.id,
      userId: socket.userId,
      username: socket.username,
      numUsers: numUsers,
      allUsers: mapToArray(m)
    });
    socket.broadcast.emit('user joined', {
      id: socket.id,
      userId: socket.userId,
      username: socket.username,
      numUsers: numUsers,
      allUsers: mapToArray(m)
    });
    socket.emit('user joined', {
      id: socket.id,
      userId: socket.userId,
      username: socket.username,
      numUsers: numUsers,
      allUsers: mapToArray(m)
    });
  });

  // when the client emits 'typing', we broadcast it to others
  socket.on('typing', function () {
    socket.broadcast.emit('typing', {
      username: socket.username
    });
  });

  // when the client emits 'stop typing', we broadcast it to others
  socket.on('stop typing', function () {
    socket.broadcast.emit('stop typing', {
      username: socket.username
    });
  });

  socket.on('user banned', function (userId) {
    var user = m.get(userId);
    if (io.sockets.connected[user.id]) {
      isBannedUser = true;
      console.log('banned', isBannedUser);
      socket.broadcast.emit('user banned', {
        id: user.id,
        userId: user.userId,
        username: user.username,
        // numUsers: numUsers,
        // allUsers: mapToArray(m)
      });
      io.sockets.connected[user.id].disconnect();
    }
    // var user = m.get(userId);
    // --numUsers;
    // m.delete(userId);
    // console.log('banned', user, mapToArray(m));
    // socket.disconnect();

  });

  // when the user disconnects.. perform this
  socket.on('disconnect', function () {
    if (addedUser) {
      --numUsers;

      m.delete(socket.userId);
      // echo globally that this client has left
      socket.broadcast.emit('user left', {
        id: socket.id,
        userId: socket.userId,
        username: socket.username,
        numUsers: numUsers,
        allUsers: mapToArray(m)
      });

      // console.log('mapToArray delete', mapToArray(m));

          // socket.broadcast.emit('user banned', {
          //   id: socket.id,
          //   userId: socket.userId,
          //   username: socket.username,
          //   numUsers: numUsers,
          //   allUsers: mapToArray(m)
          // });
          // isBannedUser = false;

    }
  });



  // BASE
  // console.log('a user connected');
  // io.emit('chat message', 'a user connected');
  //
  // socket.on('disconnect', function () {
  //   console.log('user disconnected');
  //   io.emit('chat message', 'user disconnected');
  // });
  //
  // socket.on('chat message', function (msg) {
  //   console.log('message: ' + msg);
  //   io.emit('chat message', msg);
  //   socket.broadcast.emit('hi');
  // });



  // socket.join('home');
  // var token = 'vb0CRZfENb8C-FWBBBSvQVa_Aka1pMXu';
  // request('http://yii-rest.dev/api/v1/statuses?access-token=' + token, function (error, response, body) {
  //   if (!error && response.statusCode == 200) {
  //     console.log(body);
  //     var statuses = JSON.parse(body);
  //     io.emit('statuses', statuses);
  //   } else {
  //     console.log(error);
  //   }
  // });




  // socket.leave('home');
  // io.emit('news', 'WELCOME', 'myarg');
  // io.to('home').emit('start', 'Home room start');
  //
  // console.log(socket.id +' user connected');
  // socket.on('disconnect', function () {
  //     console.log(socket.id + ' user disconnected');
  // });
  //
  // socket.on('chat message', function (msg, formData) {
  //     request.post({
  //         url:'http://yii-rest.dev/api/v1/statuses?access-token=' + token,
  //         form: formData
  //     }, function (err, httpResponse, body) {
  //         console.log(body);
  //         io.emit('add status', JSON.parse(body));
  //     });
  //
  //     socket.broadcast.emit('news', 'WELCOME 2');
  //     console.log(socket.id + ' message: ' + msg);
  //     io.emit('chat message', msg);
  // });

  // io.emit('news', { post: 'First post' });
});

// var news = io.of('/news');
//
// news.on('connection', function (socket) {
//     news.emit('news', 'NEWS');
// });



http.listen(3000, function () {
  console.log('listening on *:3000');
});


function mapToArray(mapData) {
  var result = [];

  mapData.forEach(function (v, k) {
    result.push(v);
  });

  return result;
}