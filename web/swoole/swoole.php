<?php
# docker run -d -p 9502:9502 -v e:/data/www/dnmp/www/swoole:/www  --network=dnmp_default --name swoole dnmp-php80
use Swoole\Websocket\Server;
include 'mysql.php';
$server = new Server('0.0.0.0', 9502);
$server->set(array(
    'worker_num' => 4,   //一般设置为服务器CPU数的1-4倍
    'daemonize' => 1,  //以守护进程执行
));
$chat_member= new ChatMember([]);
$chat_record = new ChatRecord([]);
$chat_msgbox = new ChatMsgbox([]);


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
    echo "Websocket Server is started at ws://127.0.0.1:9502\n";
});

$server->on('open', function($server, $req) {

    error_log(date('Y-m-d H:i:s')."'\t".$req->fd.PHP_EOL,3,'./swoole.log');
    echo "connection open: {$req->fd}\n";
});

$server->on('message', function($server, $frame) use($chat_member,$chat_msgbox,$chat_record) {
    echo "received message: {$frame->data}\n";
    $frame_data = json_decode($frame->data,true);
    error_log(date('Y-m-d H:i:s')."'\t".$frame->fd."\t".var_export($frame_data,true).PHP_EOL,3,'./swoole.log');
    $chat_member_data['username'] =$frame_data['from_username'];
    if(isset($frame_data['is_heart_beat']) && $frame_data['is_heart_beat']==1){

        $server->push($frame->fd, json_encode($frame_data));
    }elseif (isset($frame_data['onopen'])&&$frame_data['onopen']===1){
        $chat_member_data['socket_id'] = $frame->fd;
        $chat_member_data['status'] = 0;
        $chat_member->save($chat_member_data);
//        $to_user = $chat_member->info(['username'=>$frame_data['to_username']]);
        $server->push($frame->fd, json_encode($frame_data));
    }else{
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
        $chat_member->save($chat_member_data);
        $to_user = $chat_member->info(['username'=>$frame_data['to_username']]);

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
        $chat_record_data['from_id'] = $frame_data['from_id'];
        $chat_record_data['to_id'] = $to_user['id'];
        $chat_record_data['from_username'] = $chat_member_data['username'];
        $chat_record_data['to_username'] = $to_user['username'];
        $chat_record_data['type'] = $frame_data['type'];
        $chat_record_data['status'] = 0;
        $chat_record_data['content'] = $frame_data['content'];
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
//    $chat_msgbox_data['from_id'] = $frame_data['user_id'];
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

        error_log(date('Y-m-d H:i:s')."'\t".$frame->fd."\t".var_export($to_user,true).PHP_EOL,3,'./swoole.log');
        $server->push($to_user['socket_id'], json_encode($frame_data));
    }


});

$server->on('close', function($server, $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();
