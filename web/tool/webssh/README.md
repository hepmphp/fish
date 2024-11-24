# webTerm
Access Linux Terminal via Browser

## Establish Connection

### Got a SSH server?
If you have a ssh server ready to connect to, update the server config in the server.js (line 54-56).

### Set up a SSH server to connect to

If you have no ssh server running, you can spin and use docker container as follows:

- Install Docker if not already

- In the terminal, go this repo and build a Docker Image (named sshdubuntu) by:
>docker build -t sshdubuntu .

- Spin a Docker container of sshdubuntu
>docker run -it -p 22:22 sshdubuntu

Now you have a ssh server running on local, the configuration is already checked in the server.js, you can move to next step - running web server.
But FYI,
- **Server Address**: *127.0.0.1*
- **Port**: *22*
- **Username**: *test*
- **Password**: *test*


### Install NodeJS and run web server

- Install NodeJS if not already.

- Install a few dependencies by running following:

>npm install express socket.io ssh2 xterm xterm-addon-fit node-ssh

- Run the server
>node server.js


** Voila! You have a web server running at: http://localhost:8000/ **


## Sources
- https://stackoverflow.com/questions/38689707/connecting-to-remote-ssh-server-via-node-js-html5-console
