<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\models;
use base\exception\LogicException;
use cms\base\Model;

class Banner extends Model
{
    public $db = 'cms';
    public  $table='cms_banner';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }


    public function get_list_info($where = array(), $limit = 1, $offset = 2, $fields = '*')
    {
        $total = $this->get_total($where);
        $banner = $this->get_list($where, $limit, $offset, $fields);
        foreach ($banner as $k=>$ban){
            $banner[$k]['status_name'] = $ban['status']==0?'正常':'删除';
        }
        return [$banner,$total['total']];
    }


}

##生成时间:2024-11-03 23:00:04 文件路径：E:\data\www\fish\web/../app//models/curd/Banner.php🐘