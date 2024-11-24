<html>
<head>
    <meta charset="utf-8">
    <title>SSH Terminal</title>
    <link rel="stylesheet" href="<?=SITE_URL?>tool/webssh/node_modules/xterm/css/xterm.css" />
    <script type="module" src="<?=SITE_URL?>tool/webssh/node_modules/xterm/lib/xterm.js"></script>
    <script type="module" src="<?=SITE_URL?>tool/webssh/node_modules/xterm-addon-fit/lib/xterm-addon-fit.js"></script>
    <script type="module" src="<?=SITE_URL?>tool/webssh/node_modules/socket.io/client-dist/socket.io.js"></script>
    <script  src="<?=SITE_URL?>tool/webssh/jquery.min.js"></script>

    <script>

        window.addEventListener('load', function() {
            socket_connect();
        }, false);
    </script>
    <style>
        body {
            font-family: helvetica, sans-serif, arial;
            font-size: 16px;
            color: #111;
        }
        h1 {
            text-align: center;
        }
        #terminal-container {
            width:100%;
            height: 100%;
            margin: 0 auto;
            padding: 2px;
            overflow: hidden;
        }
        #terminal-container .terminal {
            color: #fafafa;
            padding: 2px;
        }
        #terminal-container .terminal:focus .terminal-cursor {
            background-color: #fafafa;
        }
    </style>
</head>
<body scroll="no" style="overflow: hidden">
<!--
<span>主机：</span>
<input type="text" value="203.57.225.216" id="host">
<span>端口：</span>
<input type="text" value="22" id="port">
<span>用户名：</span>
<input type="text" value="root" id="username">
<span>密码：</span>
<input type="password" value="He@199033028" id="password">

<input type="button" id="btn-submit" value="login">
-->
<div id="terminal-container"></div>
</body>
<script>

    console.log(param);
    function socket_connect() {
        var host = "<?=$form['host']?>";
        var port = "<?=$form['port']?>";
        var username = "<?=$form['username']?>";
        var password =  "<?=$form['password']?>";
        var is_change_user = 1;
        var param = {
            host:host,
            port:port,
            username:username,
            password:password,
            is_change_user:is_change_user
        };
        $('#terminal-container').html('');
        var terminalContainer = document.getElementById('terminal-container');
        const term = new Terminal({ cursorBlink: true });
        const fitAddon = new FitAddon.FitAddon();
        term.loadAddon(fitAddon);
        term.open(terminalContainer);
        fitAddon.fit();
        window.socket,socket = io('127.0.0.1:8000/'); //.connect();
        // Browser -> Backend
        term.onKey(function (ev) {
            socket.emit('data', ev.key);
        });

        // Backend -> Browser
        socket.on('data', function(data) {
            term.write(data);
        });

        socket.on('disconnect', function() {
            term.write('\r\n*** Disconnected from backend ***\r\n');
        });

        console.log('socke-send');
        window.socket.send(param);
    }

</script>
</html>
