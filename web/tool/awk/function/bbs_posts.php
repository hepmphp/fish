<?php

function get_where($param){

    $where = array();
    $where_str = "";
    if(isset($param['stamp']) ){
        $where[] = "$0=={$param['stamp']}";
    }
    if(isset($param['fid']) ){
        $where[] = "$1=={$param['fid']}";
    }
    if(isset($param['forum_name']) ){
        $where[] = "$2=={$param['forum_name']}";
    }
    if(isset($param['pid']) ){
        $where[] = "$3=={$param['pid']}";
    }
    if(isset($param['subject']) ){
        $where[] = "$4=={$param['subject']}";
    }
    if(isset($param['content']) ){
        $where[] = "$5=={$param['content']}";
    }
    if(isset($param['created_time']) ){
        $where[] = "$6=={$param['created_time']}";
    }
    if(isset($param['user_id']) ){
        $where[] = "$7=={$param['user_id']}";
    }
    if(isset($param['username']) ){
        $where[] = "$8=={$param['username']}";
    }
    if(isset($param['ip']) ){
        $where[] = "$9=={$param['ip']}";
    }
    if(isset($param['modified_time']) ){
        $where[] = "$10=={$param['modified_time']}";
    }
    if(isset($param['modified_username']) ){
        $where[] = "$11=={$param['modified_username']}";
    }
    if(isset($param['modified_userid']) ){
        $where[] = "$12=={$param['modified_userid']}";
    }
    if(isset($param['modified_ip']) ){
        $where[] = "$13=={$param['modified_ip']}";
    }
    if(isset($param['total_reply']) ){
        $where[] = "$14=={$param['total_reply']}";
    }
    if(isset($param['status']) ){
        $where[] = "$15=={$param['status']}";
    }

    if(!empty($where)){
        $where_str = " && ".implode(" && ",$where);
    }else{
        $where_str = 1;
    }
    return $where_str;
}

/**
 *
 * @param $param
 */
//http://log.bajian.wan.sogou.com/index.php?a=get_ingot_expend_log&server_id=10001
function get_bbs_posts($param){

    $where_str = get_where($param);
    //登录时间，角色id，角色等级，平台id，区服id，战力，登录ip,
    $cmd = <<<EOT
cat {$param['log_path']}bbs_posts_[0-9]*.txt |awk -F"," '{print $0}'
EOT;
    $cmd = sprintf($cmd,$where_str);
    $data = exec_cmd($cmd,$param);
    $log = array();
    foreach($data['data'] as $k=>$v){
        $log_arr = explode(",",$v);
        $log[] = array(
            'id'=>$log_arr[0],//id
            'stamp'=>$log_arr[1],//帖子鉴定
            'fid'=>$log_arr[2],//板块id
            'forum_name'=>$log_arr[3],//板块名称
            'pid'=>$log_arr[4],//父id
            'subject'=>$log_arr[17],//主题
            'content'=>$log_arr[6],//内容
            'created_time'=>$log_arr[7],//发帖时间
            'user_id'=>$log_arr[8],//用户id
            'username'=>$log_arr[9],//用户名
            'ip'=>$log_arr[10],//用户ip
            'modified_time'=>$log_arr[11],//修改帖子时间
            'modified_username'=>$log_arr[12],//修改帖子的用户
            'modified_userid'=>$log_arr[13],//修改贴子的用户id
            'modified_ip'=>$log_arr[14],//修改帖子的ip
            'total_reply'=>$log_arr[15],//帖子回复数
            'status'=>$log_arr[16],//帖子状态
        );
//        $log[] = array(
//            'gid'=>$log_arr[0],
//
//        );
    }
    ajax_return($data['total'],$data['per_page'],$data['total_page'],$data['page'],$log);
}