 #!/bin/sh
 echo `date +"%Y-%m-%d %H:%M:%S"`
 GIT_PATH=$1
 DEPLOY_PATH=/data/www/git
 if [ ! -d "$DEPLOY_PATH" ]; then
    mkdir -p $DEPLOY_PATH
 fi
  if [ ! -d "$DEPLOY_PATH/$GIT_PATH" ]; then
     mkdir -p /data/logs/rsync/ && chmod 777 -R /data/logs/rsync/
     mkdir -p $DEPLOY_PATH/$GIT_PATH.backup && chmod 777 -R  $DEPLOY_PATH/$GIT_PATH.backup
  fi

 unset  GIT_DIR #这条命令很重要
 cd $DEPLOY_PATH
 #git stash

 if [ ! -d "$DEPLOY_PATH/$GIT_PATH" ]; then
    git clone http://gogs:3000/hepm/$GIT_PATH.git
 else
    cd $DEPLOY_PATH
    rm -rf $GIT_PATH
    git clone http://gogs:3000/hepm/$GIT_PATH.git
    #git pull origin master
    #git fetch --all
    #git reset --hard origin/master
 fi

 #chown root:root -R $DEPLOY_PATH
 chmod 777 -R  $DEPLOY_PATH
 echo "success deploy..."
 echo `date +"%Y-%m-%d %H:%M:%S"`
