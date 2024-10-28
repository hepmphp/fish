<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace models\curd;
use base\Model;

class Tag extends Model
{
    public  $table='cms_tag';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }



}

##生成时间:2024-10-19 10:52:59 文件路径：E:\data\www\fish\web/../app//models/curd/Tag.php🐘