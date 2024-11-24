var fs = require('fs');
var path = require('path');
var server = require('http').createServer(onRequest);


var io = require('socket.io')(server, {
  cors: {
    origin: "*", // 允许跨域的前端域名
    methods: ["GET", "POST"], // 允许的跨域请求方法
    transports: ['websocket', 'polling'], // 允许的跨域通信传输方式
    credentials: true // 允许cookies等认证信息一起跨域传递
  }
});
var SSHClient = require('ssh2').Client;

// Load static files into memory
var staticFiles = {};
var basePath = path.join(require.resolve('xterm'), '..');
staticFiles['/xterm.css'] = fs.readFileSync(path.join(basePath, '../css/xterm.css'));
staticFiles['/xterm.js'] = fs.readFileSync(path.join(basePath, 'xterm.js'));
basePath = path.join(require.resolve('xterm-addon-fit'), '..');
staticFiles['/xterm-addon-fit.js'] = fs.readFileSync(path.join(basePath, 'xterm-addon-fit.js'));
staticFiles['/'] = fs.readFileSync('index.html');

// Handle static file serving
function onRequest(req, res) {
  var file;
  if (req.method === 'GET' && (file = staticFiles[req.url])) {
    res.writeHead(200, {
      'Content-Type': 'text/'
        + (/css$/.test(req.url)
        ? 'css'
        : (/js$/.test(req.url) ? 'javascript' : 'html'))
    });
    return res.end(file);
  }
  res.writeHead(404);
  res.end();
}




io.on('connection', function(socket) {
  console.log('connection');
  var conn = new SSHClient();
  conn.on('ready', function() {
    socket.emit('data', '\r\n*** SSH CONNECTION ESTABLISHED ***\r\n');
    conn.shell(function(err, stream) {
      if (err)
        return socket.emit('data', '\r\n*** SSH SHELL ERROR: ' + err.message + ' ***\r\n');
      socket.on('data', function(data) {
        stream.write(data);
      });
      stream.on('data', function(d) {
        socket.emit('data', d.toString('binary'));
      }).on('close', function() {
        conn.end();
      });
    });
  }).on('close', function() {
    socket.emit('data', '\r\n*** SSH CONNECTION CLOSED ***\r\n');
  }).on('error', function(err) {
    socket.emit('data', '\r\n*** SSH CONNECTION ERROR: ' + err.message + ' ***\r\n');
  });

  socket.on('message', function(data) {
    console.log(data);
    if (data.is_change_user != undefined && data.is_change_user == 1) {
      var config = {
        host: data.host,
        port: data.port,
        username: data.username,
        password: data.password
        //privateKey: require('fs').readFileSync('path/to/keyfile')
      };
      io.on('connection', function(socket) {
        var conn = new SSHClient();
        conn.on('ready', function() {
          socket.emit('data', '\r\n*** SSH CONNECTION ESTABLISHED ***\r\n');
          conn.shell(function(err, stream) {
            if (err)
              return socket.emit('data', '\r\n*** SSH SHELL ERROR: ' + err.message + ' ***\r\n');
            socket.on('data', function(data) {
              stream.write(data);
            });
            stream.on('data', function(d) {
              socket.emit('data', d.toString('binary'));
            }).on('close', function() {
              conn.end();
            });
          });
        }).on('close', function() {
          socket.emit('data', '\r\n*** SSH CONNECTION CLOSED ***\r\n');
        }).on('error', function(err) {
          socket.emit('data', '\r\n*** SSH CONNECTION ERROR: ' + err.message + ' ***\r\n');
        });
      });
      conn.connect(config);

    }
  });


});


let port = 8000;

server.listen(port,function () {
  console.log('Listening on port', port)
});
