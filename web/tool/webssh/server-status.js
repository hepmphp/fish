const express = require('express');
var SSHClient = require('ssh2').Client;
const { NodeSSH } = require('node-ssh');


var http = require('http');
// 创建Express应用
const app = express();

// 创建HTTP服务器并将其与Express应用绑定
const server = http.createServer(app);

// 创建Socket.io服务器并将其与HTTP服务器绑定
var io = require('socket.io')(server, {
  cors: {
    origin: "*", // 允许跨域的前端域名
    methods: ["GET", "POST",'PUT','DELETE','OPTION'], // 允许的跨域请求方法
    transports: ['websocket', 'polling'], // 允许的跨域通信传输方式
    credentials: true // 允许cookies等认证信息一起跨域传递
  }
});


const PORT = 8900;
server.listen(PORT, () => console.log(`Server is running on port ${PORT}`));

// 当客户端连接时执行
io.on('connection', (socket) => {
  console.log('A client has connected');
  // 监听自定义事件
  socket.on('message', function(data) {
    console.log(' data:', data);
    if (data.is_change_user != undefined && data.is_change_user == 1) {
      var config = {
        host: data.host,
        port: data.port,
        username: data.username,
        password: data.password
        //privateKey: require('fs').readFileSync('path/to/keyfile')
      };
      var cmd = data.cmd;

      const ssh = new NodeSSH();
      async function run() {
        try {
          await ssh.connect(config);
          const result =   await ssh.execCommand(cmd);
          console.log(result);
          socket.emit('data', result.stdout.split('\n'));
          // 关闭连接
          await ssh.dispose();
        } catch (error) {
          console.error(error);
        }
      }

      run();
    }
    // 当客户端断开连接时执行
    socket.on('disconnect', () => {
      console.log('A client has disconnected');
    });
  });
});



