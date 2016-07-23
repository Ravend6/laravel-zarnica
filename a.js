var m = new Map();

var root = { id: 1, username: 'root'};
var vova = { id: 2, username: 'vova'};
var admin = { id: 3, username: 'admin'};

m.set(vova.id, vova);
m.set(root.id, root);
m.set(admin.id, admin);

// console.log(m);
// console.log(m.get(1));
// console.log(m.delete(1));
// console.log(m.values());
// console.log(m.entries());
var users = [];
m.forEach(function (v, k) {
  users.push(v)
});

console.log(users);
