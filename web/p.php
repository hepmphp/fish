<?php
phpinfo();
$chat_record_data['from_id'] = 1;
$chat_record_data['to_id'] = 2;
$chat_record_data['from_username'] = 'hepm';
$chat_record_data['to_username'] = 'fish';
$chat_record_data['type'] = 1;
$chat_record_data['status'] = 0;
$chat_record_data['content'] ='很好很强大'.date("Y-m-d H:i:s");
$chat_record_data['group_id'] = 1;
$chat_record_data['send_time'] = time();
$chat_record_data['create_time'] = time();
$res = json_encode($chat_record_data,JSON_UNESCAPED_UNICODE);

echo($res);
