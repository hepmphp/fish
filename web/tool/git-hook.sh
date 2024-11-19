 #!/bin/sh
 DEPLOY_PATH=/data/www/git
 if [ ! -d "$DEPLOY_PATH" ]; then
    mkdir -p $DEPLOY_PATH
    mkdir -p /data/logs/rsync/ && chmod 777 -R /data/logs/rsync/
    mkdir -p $DEPLOY_PATH/fish.backup && chmod 777 -R  $DEPLOY_PATH/fish.backup
 fi
 unset  GIT_DIR #这条命令很重要
 cd $DEPLOY_PATH
 #git stash

 if [ ! -d "$DEPLOY_PATH/fish" ]; then
    git clone http://gogs:3000/hepm/fish.git
 else
    cd $DEPLOY_PATH
    rm -rf fish
    git clone http://gogs:3000/hepm/fish.git
    #git pull origin master
    #git fetch --all
    #git reset --hard origin/master
 fi

 #chown root:root -R $DEPLOY_PATH
 chmod 777 -R  $DEPLOY_PATH
 echo "success deploy..."
