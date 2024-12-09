<?php

# docker run -d -p 9501:9501 -v e:/data/www/dnmp/fish/im/controllers/swoole:/www  --network=dnmp_default --name swoole dnmp-php80
use Swoole\Websocket\Server;
include 'mysql.php';
include 'Arr.php';
$server = new Server('0.0.0.0', 9501);
//$server->set(array(
//    'worker_num' => 4,   //一般设置为服务器CPU数的1-4倍
//    'daemonize' => 1,  //以守护进程执行
//));
$chat_member= new ChatMember([]);
$chat_record = new ChatRecord([]);
$chat_msgbox = new ChatMsgbox([]);
$chat_group = new ChatGroup([]);
$chat_group_member = new ChatGroupMember([]);

set_error_handler('error_handler',E_ALL);
set_exception_handler('exception_handler');
register_shutdown_function('shutdown_handler');

/**
 * 错误处理函数
 * @param $errno
 * @param $errstr
 * @param string $errfile
 * @param string $errline
 * @param array $errcontext
 */
function error_handler($errno,$errstr,$errfile='',$errline='',$errcontext=array()){
    $time = date("Y-m-d H:i:s");
    $errcode = -100;
    $log_message = "错误代码:[%s],错误信息:[%s],文件:[%s],行号:[%d],地址:[%s],来源:[%s]";
    $url =     '';
    $referer = '';
    $log_message_format = $time."|".sprintf($log_message,$errcode,$errstr,$errfile,$errline,$url,$referer);
     error_log($log_message_format.PHP_EOL,3,'./error_handler.log');
}

/**
 *php错误邮件告警
 */
function shutdown_handler(){
    $last_error = error_get_last();
    if (isset($last_error['type']))
    {
        $time = date("Y-m-d H:i:s");
        $email_msg = 'PHP Fatal Error '.$time;
        $email_content[] = "Error:".print_r($last_error, true);
        $email_content[] = "Time:".$time;
        $email_content[] = "Request: ".print_r($GLOBALS,true);
        $email_content_msg = "<pre>".$email_msg.PHP_EOL.implode(PHP_EOL,$email_content);
        error_log($email_content_msg.PHP_EOL,3,'./error_handler.log');

    }
}
function exception_handler($exception) {
    echo( json_encode( array('status' =>$exception->getCode(),'msg'  =>$exception->getMessage()),JSON_UNESCAPED_UNICODE));
}





$server->on('start', function ($server) {
    echo "Websocket Server is started at ws://127.0.0.1:9501\n";
});

$server->on('open', function($server, $req) {

    error_log(date('Y-m-d H:i:s')."'\t".$req->fd.PHP_EOL,3,'./swoole.log');
    echo "connection open: {$req->fd}\n";
});

$server->on('message', function($server, $frame) use($chat_member,$chat_msgbox,$chat_record,$chat_group,$chat_group_member) {
    echo "received message: {$frame->data}\n";
    $frame_data = json_decode($frame->data,true);
    error_log(date('Y-m-d H:i:s')."'\t".$frame->fd."\t".var_export($frame_data,true).PHP_EOL,3,'./swoole.log');
    if(isset($frame_data['is_heart_beat']) && $frame_data['is_heart_beat']==1){
        $server->push($frame->fd, json_encode($frame_data));
    }elseif (isset($frame_data['type'])&&$frame_data['type']==='onconnect'){
        $chat_member_data['id'] = $frame_data['id'];
        $chat_member_data['socket_id'] = $frame->fd;
        $chat_member_data['status'] = 0;
        unset($chat_member_data['username']);
        $chat_member->save($chat_member_data);
//        $to_user = $chat_member->info(['username'=>$frame_data['to_username']]);
        $server->push($frame->fd, json_encode($frame_data));
    }elseif (isset($frame_data['type']) && $frame_data['type']=='chatMsgbox'){



        //{"type":"","data":{"action":"add_friend","from_id":1,"friend_id":"1","friend_username":"用户6011","groupId":"5","remark":"11111"}}
        /**
         *
        Column	Type	Comment
        id	int unsigned Auto Increment
        from_id	int unsigned [0]	消息发送者id
        to_id	int unsigned [0]	消息接收者id
        from_username	varchar(32) []	消息发送者
        to_username	varchar(32) []	消息接收者
        type	tinyint unsigned [0]	消息类型|0:请求添加用户,1:系统消息(加好友) ,2:请求加群,3:系统消息(加群)
        status	tinyint unsigned [0]	状态|0:待处理,1:同意,2:拒绝,3:无须处理
        remark	varchar(128) NULL []	附加消息
        content	text	信息备注
        friend_group_id	int NULL [0]	好友分组ID
        group_id	int NULL [0]	群ID
        send_time	int unsigned [0]	发送消息时间
        read_time	int unsigned NULL [0]	读消息时间
        create_time	int unsigned [0]	创建时间
        update_time	int unsigned NULL [0]	修改时间
        delete_time	int unsigned NULL [0]	删除时间
         */

        if($frame_data['data']['action']=='add_group'){
            $chat_msgbox_data['from_id'] = $frame_data['data']['from_id'];
            $chat_msgbox_data['to_id'] = 0;
            $chat_msgbox_data['from_username'] = $frame_data['data']['from_username'];
            $chat_msgbox_data['to_username'] = 0;
            $chat_msgbox_data['type'] = 2;
            $chat_msgbox_data['status'] = 0;
            $chat_msgbox_data['remark'] = $frame_data['data']['remark'];
            $chat_msgbox_data['content'] = '';
            $chat_msgbox_data['group_id'] = $frame_data['data']['group_id'];
            $chat_msgbox_data['send_time'] =time();
            $chat_msgbox_data['create_time'] = time();
            $chat_msgbox_data['update_time'] = 0;
            $chat_msgbox_data['delete_time'] = 0;

            $chat_msgbox->create($chat_msgbox_data);

            $to_group =  $chat_group->info(['id'=>$frame_data['data']['group_id']]);

            $chat_member_data['id'] = $to_group['belong_id'];
            $chat_member_data['socket_id'] = $frame->fd;
            $chat_member_data['status'] = 0;
            $chat_member->save($chat_member_data);
            $to_user = $chat_member->info(['id'=>$to_group['belong_id']]);


            $chat_record_data['from_id'] = $frame_data['data']['from_id'];
            $chat_record_data['to_id'] = $to_user['id'];
            $chat_record_data['from_username'] = $frame_data['data']['from_username'];
            $chat_record_data['to_username'] = $to_user['username'];
            $chat_record_data['type'] = 0;
            $chat_record_data['status'] = 0;
            $chat_record_data['content'] =  isset($frame_data['data']['content'])&&!empty($frame_data['data']['content'])?$frame_data['data']['content']:'';
            $chat_record_data['send_time'] = time();
            $chat_record_data['create_time'] = time();
            $chat_record->create($chat_record_data);

            $chat_member_data['socket_id'] = $frame->fd;


            $frame_to_data['from_id'] = 0;
            $frame_to_data['to_id'] = $frame_data['data']['from_id'];
            $frame_to_data['from_username'] = 0;
            $frame_to_data['to_username'] = $frame_data['data']['from_username'];
            $frame_to_data['type'] = 'group';
            $frame_to_data['status'] = 0;
            $frame_to_data['content'] = 'hahaha add group......';
            $frame_to_data['send_time'] =time();
            $frame_to_data['create_time'] = time();
            $frame_to_data['update_time'] = 0;
            $frame_to_data['delete_time'] = 0;
            var_dump('to_user',$to_user,'socket_id:', $frame->fd);
//        $to_user = $chat_member->info(['username'=>$frame_data['to_username']]);
            $server->push($to_user['socket_id'], json_encode($frame_to_data));
        }else{
            $chat_msgbox_data['from_id'] = $frame_data['data']['from_id'];
            $chat_msgbox_data['to_id'] = $frame_data['data']['friend_id'];
            $chat_msgbox_data['from_username'] = $frame_data['data']['from_username'];
            $chat_msgbox_data['to_username'] = $frame_data['data']['friend_username'];
            $chat_msgbox_data['type'] = 0;
            $chat_msgbox_data['status'] = 0;
            $chat_msgbox_data['remark'] = $frame_data['data']['remark'];
            $chat_msgbox_data['content'] = isset($frame_data['data']['content'])&&!empty($frame_data['data']['content'])?$frame_data['data']['content']:'';
            $chat_msgbox_data['group_id'] = $frame_data['data']['group_id'];
            $chat_msgbox_data['send_time'] =time();
            $chat_msgbox_data['create_time'] = time();
            $chat_msgbox_data['update_time'] = 0;
            $chat_msgbox_data['delete_time'] = 0;
            var_dump($chat_msgbox_data);
            $chat_msgbox->create($chat_msgbox_data);


            $chat_member_data['socket_id'] = $frame->fd;
            $chat_member_data['status'] = 0;

            $chat_member->save($chat_member_data);
            $to_user = $chat_member->info(['id'=>$frame_data['data']['friend_id']]);

//
            $chat_record_data['from_id'] = $frame_data['data']['from_id'];
            $chat_record_data['to_id'] = $to_user['id'];
            $chat_record_data['from_username'] = $frame_data['data']['from_username'];
            $chat_record_data['to_username'] = $to_user['username'];
            $chat_record_data['type'] = 0;
            $chat_record_data['status'] = 0;
            $chat_record_data['content'] =  isset($frame_data['data']['content'])&&!empty($frame_data['data']['content'])?$frame_data['data']['content']:'';
            $chat_record_data['send_time'] = time();
            $chat_record_data['create_time'] = time();
            $chat_record->create($chat_record_data);

            $chat_member_data['socket_id'] = $frame->fd;


            $frame_to_data['from_id'] = $frame_data['data']['friend_id'];
            $frame_to_data['to_id'] = $frame_data['data']['from_id'];
            $frame_to_data['from_username'] = $frame_data['data']['friend_username'];
            $frame_to_data['to_username'] = $frame_data['data']['from_username'];
            $frame_to_data['type'] = 0;
            $frame_to_data['status'] = 0;
            $frame_to_data['content'] = 'hahaha add friend......';
            $frame_to_data['send_time'] =time();
            $frame_to_data['create_time'] = time();
            $frame_to_data['update_time'] = 0;
            $frame_to_data['delete_time'] = 0;
            var_dump('to_user',$to_user,'socket_id:', $frame->fd);
//        $to_user = $chat_member->info(['username'=>$frame_data['to_username']]);
            $server->push($to_user['socket_id'], json_encode($frame_to_data));
        }


        echo "send firend msg....1";
    }elseif (isset($frame_data['type']) && $frame_data['type']=='invate_message'){

        $member_sockets = $chat_member->info(['id'=>$frame_data['to_id']]);
        $member_index_sockets[$frame_data['to_id']] = $member_sockets;
        var_dump('member_sockets',$member_index_sockets);
        $chat_record_data['avatar'] = isset($member_index_sockets[$frame_data['to_id']])?$member_index_sockets[$frame_data['to_id']]['avatar']:'';
        $chat_record_data['group_id'] = isset($frame_data['group_id'])?$frame_data['group_id']:0;
        $chat_record_data['from_id'] = 0;
        $chat_record_data['to_id'] = isset($frame_data['to_id'])?$frame_data['to_id']:0;
        $chat_record_data['from_username'] = 0;
        $chat_record_data['to_username'] = $member_sockets['username'];
        $chat_record_data['type'] = 3;
        $chat_record_data['status'] = 0;
        $chat_record_data['content'] = '发送加入群邀请';
        $chat_record_data['send_time'] = time();
        $chat_record_data['create_time'] = time();
        $chat_record_id = $chat_record->create($chat_record_data);

        $chat_msgbox_data['avatar'] =   $chat_record_data['avatar'];
        $chat_msgbox_data['from_id'] =0;
        $chat_msgbox_data['to_id'] =  $chat_record_data['to_id'];
        $chat_msgbox_data['from_username'] = 0;
        $chat_msgbox_data['to_username'] =  $member_sockets['username'];
        $chat_msgbox_data['type'] = 3;
        $chat_msgbox_data['status'] = 0;
        $chat_msgbox_data['remark'] = '邀请加入群,群号：'.$frame_data['group_id'];
        $chat_msgbox_data['content'] =  '邀请加入群,群号：'.$frame_data['group_id'];
        $chat_msgbox_data['group_id'] =  $chat_record_data['group_id'] ;
        $chat_msgbox_data['send_time'] =time();
        $chat_msgbox_data['create_time'] = time();
        $chat_msgbox_data['update_time'] = 0;
        $chat_msgbox_data['delete_time'] = 0;
        var_dump($chat_msgbox_data);
        $chat_msgbox_id = $chat_msgbox->create($chat_msgbox_data);

        $frame_to_data['chat_msgbox_id'] = $chat_msgbox_id;
        $frame_to_data['group_id'] = $chat_record_data['group_id'];
        $frame_to_data['from_id'] = 0;
        $frame_to_data['to_id'] = $chat_record_data['to_id'];
        $frame_to_data['from_username'] = 0;
        $frame_to_data['to_username'] = $chat_record_data['to_username'];
        $frame_to_data['type'] =   3;
        $frame_to_data['status'] = 0;
        $frame_to_data['content'] = '群邀加入群';
        $frame_to_data['send_time'] =time();
        $frame_to_data['create_time'] = date("Y-m-d H:i:s",time());
        $frame_to_data['update_time'] = 0;
        $frame_to_data['delete_time'] = 0;
        $static_url = 'http://127.0.0.1/upload/';
        $to_user = $chat_member->info(['id'=>$frame_data['to_id']]);
        $frame_to_data['from_avatar'] = $static_url.$chat_record_data['avatar'];
        error_log(date('Y-m-d H:i:s')."'\t".$frame->fd."\t".var_export($to_user,true).PHP_EOL,3,'./swoole.log');
        $server->push($to_user['socket_id'], json_encode($frame_to_data));
        echo "invate send to friend...";

    }else{
        if(empty($frame_data)){
            $server->push($frame->fd, json_encode(['code'=>-100,'msg'=>'传递的数据为空']) );
            return 0;
        }

        /**
        socket_id	int unsigned [0]	socket连接id
        username	varchar(32)	账号
        password	varchar(32)	发送者
        salt	varchar(20)	密钥
        nickname	varchar(50) [匿名]	昵称
        avatar	varchar(100) [/static/images/pkq.png]	头像
        signature	varchar(100) []	签名
        status	tinyint unsigned [1]	在线状态 0在线 1下线 2隐身
        login_time	int unsigned [0]	上次登录时间
        create_time	int unsigned [0]	创建时间
        update_time	int unsigned NULL [0]	修改时间
        delete_time	int unsigned NULL [0]	删除时间
         */
//        $chat_member_data['username'] =$frame_data['from_username'];
        $chat_member_data['socket_id'] = $frame->fd;
        $chat_member_data['status'] = 0;
        unset($chat_member_data['username']);
        $chat_member->save_socket_id($chat_member_data);
        // {"from_id":1,"to_id":"2","from_username":"hepm","to_username":"fish","type":1,"status":0,"content":"1111","group_id":1,"send_time":1731248989,"create_time":1731248989}


        /**
         *
        Column	Type	Comment
        from_id	int unsigned [0]	发送者id
        to_id	int unsigned [0]	接收者id
        from_username	varchar(255) [0]	消息发送者id
        to_username	varchar(255) [0]	消息接收者id
        content	text	发送内容
        type	tinyint unsigned [0]	聊天类型
        send_time	int unsigned [0]	发送时间
        create_time	int unsigned [0]	创建时间
        update_time	int unsigned [0]	更新时间
        delete_time	int unsigned [0]	删除时间
        status	tinyint [0]	状态|0:正常,-1:删除

         */

        if($frame_data['type']==2){
            $members = $chat_group_member->find_all(['group_id'=>$frame_data['group_id']],0,10000);
            $members = Arr::getColumn($members,'member_id');
            $members = array_unique($members);
            $member_sockets = $chat_member->find_all(['id'=>$members],1,10000);
            $member_index_sockets= Arr::index($member_sockets,'id');

        }else{
            $member_sockets = $chat_member->info(['id'=>$frame_data['from_id']]);
            $member_index_sockets[$frame_data['from_id']] = $member_sockets;
        }
        var_dump('member_sockets',$member_index_sockets);
        $chat_record_data['avatar'] = isset($member_index_sockets[$frame_data['from_id']])?$member_index_sockets[$frame_data['from_id']]['avatar']:'';
        $chat_record_data['group_id'] = isset($frame_data['group_id'])?$frame_data['group_id']:0;
        $chat_record_data['from_id'] = $frame_data['from_id'];
        $chat_record_data['to_id'] = isset($frame_data['to_id'])?$frame_data['to_id']:0;
        $chat_record_data['from_username'] = $frame_data['from_username'];
        $chat_record_data['to_username'] = $frame_data['to_username'];
        $chat_record_data['type'] = $frame_data['type'];
        $chat_record_data['status'] = 0;
        $chat_record_data['content'] = addslashes($frame_data['content']);
        $chat_record_data['send_time'] = time();
        $chat_record_data['create_time'] = time();

        $chat_record->create($chat_record_data);
        /**
         *  from_id	int unsigned [0]	消息发送者id
        to_id	int unsigned [0]	消息接收者id
        from_username	varchar(32) []	消息发送者
        to_username	varchar(32) []	消息接收者
        type	tinyint unsigned [0]	0请求添加用户 1系统消息(加好友) 2请求加群 3系统消息(加群)
        status	tinyint unsigned [0]	0待处理 1同意 2拒绝 3无须处理
        remark	varchar(128) NULL	附加消息
        content	varchar(255)	信息备注
        friend_group_id	int NULL	好友分组ID
        group_id	int NULL	群ID
        send_time	int unsigned [0]	发送消息时间
        read_time	int unsigned NULL [0]	读消息时间
        create_time	int unsigned [0]	创建时间
        update_time	int unsigned NULL [0]	修改时间
        delete_time	int unsigned NULL [0]	删除时间
         */
//    $chat_msgbox_data['from_id'] = $frame_data['from_id'];
//    $chat_msgbox_data['to_id'] = $to_user['id'];
//    $chat_msgbox_data['from_username'] = $chat_member_data['username'];
//    $chat_msgbox_data['to_username'] = $to_user['username'];
//    $chat_msgbox_data['type'] = $frame_data['type'];
//    $chat_msgbox_data['status'] = $frame_data['status'];
//    $chat_msgbox_data['remark'] = $frame_data['remark'];
//    $chat_msgbox_data['content'] = $frame_data['content'];
//    $chat_msgbox_data['friend_group_id'] = $frame_data['friend_group_id'];
//    $chat_msgbox_data['group_id'] = $frame_data['group_id'];
//    $chat_msgbox_data['send_time'] = time();
//    $chat_msgbox_data['create_time'] = time();
//    $chat_msgbox->create($chat_msgbox_data);
        $frame_to_data['group_id'] = $chat_record_data['group_id'];
        $frame_to_data['from_id'] = $chat_record_data['to_id'];
        $frame_to_data['to_id'] = $chat_record_data['from_id'];
        $frame_to_data['from_username'] = $chat_record_data['to_username'];
        $frame_to_data['to_username'] = $frame_data['from_username'];
        $frame_to_data['type'] =   $chat_record_data['group_id']>0?2:1;
        $frame_to_data['status'] = 0;
        $frame_to_data['content'] = $frame_data['content'];
        $frame_to_data['send_time'] =time();
        $frame_to_data['create_time'] = date("Y-m-d H:i:s",time());
        $frame_to_data['update_time'] = 0;
        $frame_to_data['delete_time'] = 0;
        var_dump($frame_to_data);
        $static_url = 'http://127.0.0.1/upload/';
        //群聊
        if( $chat_record_data['type']==2){


            $frame_to_data['from_avatar'] = $static_url.$member_sockets[$chat_record_data['from_id']]['avatar'];
          //  $frame_to_data['to_avatar'] = $static_url.$member_sockets[$chat_record_data['to_id']]['avatar'];
            foreach ($member_sockets as $socket){
                        if($socket['id']!=$chat_record_data['from_id']){
                            error_log(date('Y-m-d H:i:s')."'\t".$frame->fd."\t".var_export($socket,true).PHP_EOL,3,'./swoole.log');
                            $server->push($socket['socket_id'], json_encode($frame_to_data));
                        }
            }

        }else{
            $to_user = $chat_member->info(['id'=>$frame_data['to_id']]);
            $frame_to_data['from_avatar'] = $static_url.$chat_record_data['avatar'];
            error_log(date('Y-m-d H:i:s')."'\t".$frame->fd."\t".var_export($to_user,true).PHP_EOL,3,'./swoole.log');
            $server->push($to_user['socket_id'], json_encode($frame_to_data));
            echo "send to friend...";
        }


    }


});

$server->on('close', function($server, $frame) use($chat_member){
    $chat_member->save_socket_id_to_zero($frame->fd);
    echo "connection close: {$frame->fd}\n";

});

$server->start();
