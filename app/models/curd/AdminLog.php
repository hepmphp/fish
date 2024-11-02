<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace models\curd;
use base\Model;

class AdminLog extends Model
{
    public  $table='admin_log';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }
    public function create($data){
        $this->insert($data);
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 2, $fields = '*')
    {
        $total = $this->get_total($where);
        $log = $this->get_list($where, $limit, $offset, $fields,'id desc');
        $config_log = [
            '1'=>'<span class="label btn-success" style="background-color: blue;" >添加</span>',
            '2'=>'<span class="label btn-success" style="background-color: red;" >修改</span>',
            '3'=>'<span class="label btn-success" style="background-color: red;" >删除</span>',
            '4'=>'<span class="label btn-success" style="background-color: blue;" >登录成功</span>',
            '5'=>'<span class="label btn-success" style="background-color: red;" >登录成功</span>',
            '6'=>'<span class="label btn-success" style="background-color: black;" >编辑权限</span>',
        ];
        foreach ($log as $k=>$v){
            //日志类型 1添加2修改3删除4登录成功5登录失败
            $log[$k]['log_type_name'] =  $config_log[$v['log_type']];
            $log[$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
            $log[$k]['info'] = mb_substr($v['info'],0,100).'...';
        }
        return [$log,$total['total']];
    }

    public function info($form){
        $res = $this->find($form,'*');
        $config_log = [
            '1'=>'<span class="label btn-success" style="background-color: blue;" >添加</span>',
            '2'=>'<span class="label btn-success" style="background-color: red;" >修改</span>',
            '3'=>'<span class="label btn-success" style="background-color: red;" >删除</span>',
            '4'=>'<span class="label btn-success" style="background-color: blue;" >登录成功</span>',
            '5'=>'<span class="label btn-success" style="background-color: red;" >登录成功</span>',
            '6'=>'<span class="label btn-success" style="background-color:black;" >编辑权限</span>',
        ];
        //日志类型 1添加2修改3删除4登录成功5登录失败
        $res['log_type_name'] =  $config_log[$res['log_type']];
        $res['addtime'] = date('Y-m-d H:i:s',$res['addtime']);
        return $res;
    }


}

##生成时间:2024-10-19 10:52:59 文件路径：E:\data\www\fish\web/../app//models/curd/AdminLog.php🐘