var io = require('socket.io').listen(3000);

var mjmChatUsernames = [];

var mysql = require('mysql');
var _ = require('underscore');
var db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root123',
    port: 3306,
    database: 'sooheeb'
});

db.connect(function (err) {
    if (!err) {
        console.log("Database is connected ... \n\n");
    } else {
        console.log("Error connecting database ... \n\n");
    }
});
io.sockets.on('connection', function (client)
{
    client.on('mjmChatAddUser', function (user, room)
    {
        // Guest
        if (user == null)
            user = mjmChatCreateGuestName();

        // Convert special characters to HTML entities
        user = htmlEntities(user);
        room = htmlEntities(room);

        client.username = user;
        client.room = room;
        mjmChatUsernames.push(user);
        client.join(room);
        //load last chat
        db.query('SELECT * from chat_history where room = "' + room + '" LIMIT 10', function (err, rows) {
            if (err) {
                console.log(err);
                return;
            }
            _.each(rows, function (ch) {
                //console.log(ch);
                client.emit('mjmChatMessage', ch.user, ch.message, formatDateSql(ch.time));
            });
        });
        //client.emit('mjmChatStatusUser', 'you have joined to ' + room + ' room');

        client.broadcast.to(room).emit('mjmChatStatusUser', user + ' has joined to this room');
        client.emit('mjmChatRooms', room);

        io.sockets.to(room).emit('mjmChatUsers', mjmChatGetUsersRoom(room));
    });

    client.on('mjmChatEnterRoom', function (newRoom)
    {
        // Convert special characters to HTML entities
        newRoom = htmlEntities(newRoom);

        var oldRoom = client.room;

        client.leave(client.room);
        client.join(newRoom);
        //load last chat
        db.query('SELECT * from chat_history where room = "' + newRoom + '" LIMIT 10', function (err, rows) {
            if (err) {
                console.log(err);
                return;
            }
            _.each(rows, function (ch) {
                //console.log(ch);
                client.emit('mjmChatMessage', ch.user, ch.message, formatDateSql(ch.time));
            });
        });
        //client.emit('mjmChatStatusUser', 'you have joined to ' + newRoom + ' room');
        client.broadcast.to(client.room).emit('mjmChatStatusUser', client.username + ' has left this room');
        client.room = newRoom;
        client.broadcast.to(newRoom).emit('mjmChatStatusUser', client.username + ' has joined this room');
        client.emit('mjmChatRooms', newRoom);

        io.sockets.to(oldRoom).emit('mjmChatUsers', mjmChatGetUsersRoom(oldRoom));
        io.sockets.to(newRoom).emit('mjmChatUsers', mjmChatGetUsersRoom(newRoom));
    });

    client.on('mjmChatMessage', function (data)
    {
        // Convert special characters to HTML entities
        data = nl2br(htmlEntities(data));

        io.sockets.to(client.room).emit('mjmChatMessage', client.username, data, formatDateSql(sqlDateNow()));

        //save to db
        saveChat(client.room, client.username, data);
    });

    client.on('disconnect', function ()
    {
        var oldRoom = client.room;
        mjmChatUsernames.splice(mjmChatUsernames.indexOf(client.username), 1);
        client.broadcast.emit('mjmChatStatusUser', client.username + ' has left this room');
        client.leave(client.room);

        io.sockets.to(oldRoom).emit('mjmChatUsers', mjmChatGetUsersRoom(oldRoom));
    });
});

function mjmChatCreateGuestName()
{
    var i = 0;
    do {
        i++;
        var checkExist = mjmChatUsernames.indexOf('Guest' + i.toString());
    }
    while (checkExist != -1);

    return 'Guest' + i.toString();
}

function mjmChatChangeUserIfExist(user)
{
    var i = 1;
    do {
        i++;
        var checkExist = mjmChatUsernames.indexOf(user + i.toString());
    }
    while (checkExist != -1);

    return 'Guest' + i.toString();
}

function mjmChatGetUsersRoom(room)
{
    var users = [];
    var clientsList = io.sockets.adapter.rooms[room];
    console.log('test : ');
    console.log(clientsList);
    console.dir(clientsList);
    /*clientsList.each(function(user) {
     users.push(user.username);
     });*/
    return users;
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

// phpjs.org/functions/nl2br
function nl2br(str, is_xhtml)
{
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function saveChat(room, user, message) {
    var data = {
        room: room,
        user: user,
        message: message,
        time: sqlDateNow()

    };

    db.query("INSERT INTO chat_history set ? ", data, function (err, rows)
    {
        if (err)
            console.log("Error inserting : %s ", err);

    });
}

function sqlDateNow() {
    var date;
    date = new Date();
    date = date.getUTCFullYear() + '-' +
            ('00' + (date.getUTCMonth() + 1)).slice(-2) + '-' +
            ('00' + date.getUTCDate()).slice(-2) + ' ' +
            ('00' + date.getUTCHours()).slice(-2) + ':' +
            ('00' + date.getUTCMinutes()).slice(-2) + ':' +
            ('00' + date.getUTCSeconds()).slice(-2);
    return date;
}

function formatDateSql(param) {
    var dt = new Date(param);
    return dt.getDate() + '/' + dt.getMonth() + '/' + dt.getFullYear() + ' ' + dt.getHours() + ':' + dt.getMinutes() + ':' + dt.getSeconds();
}