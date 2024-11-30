<?php

function get_where($param){

    $where = array();
    $where_str = "";
[where_field]

    if(!empty($where)){
        $where_str = " && ".implode(" && ",$where);
    }
    return $where_str;
}

/**
 *
 * @param $param
 */
//http://log.bajian.wan.sogou.com/index.php?a=get_ingot_expend_log&server_id=10001
function get_[database]_log($param){

    $where_str = get_where($param);
    //登录时间，角色id，角色等级，平台id，区服id，战力，登录ip,
    $cmd = <<<EOT
cat {$param['log_path']}/[table]_[0-9]*.txt |awk -F" " '{print $3}'|awk -F"," '{if(%s){print $0}else{}}'
EOT;
    $cmd = sprintf($cmd,$param['begin_time'],$param['end_time'],$where_str);
    $data = exec_cmd($cmd,$param);
    $log = array();
    foreach($data['data'] as $k=>$v){
        $log_arr = explode(",",$v);
        [log_data_fields]
//        $log[] = array(
//            'gid'=>$log_arr[0],
//
//        );
    }
    ajax_return($data['total'],$data['per_page'],$data['total_page'],$data['page'],$log);
}