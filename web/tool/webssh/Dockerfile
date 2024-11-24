#Build: docker build -t sshdubuntu .

# Pull base image
FROM ubuntu:latest

# install the openssh package for ssh
RUN apt update && apt install  openssh-server sudo -y

RUN useradd -rm -d /home/ubuntu -s /bin/bash -g root -G sudo -u 1000 test

# Add a user "test"
RUN  echo 'test:test' | chpasswd

# Start ssh service
RUN service ssh start

# Expose the port 22 to let in ssh connections
EXPOSE 22

CMD ["/usr/sbin/sshd","-D"]
