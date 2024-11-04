<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd;
use app\base\Model;

class AdBlock extends Model
{
    public  $table='cms_ad_block';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }



}

##生成时间:2024-10-19 10:52:58 文件路径：E:\data\www\fish\web/../app//models/curd/AdBlock.php🐘