<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd;
use app\base\exception\LogicException;
use app\base\Model;
use app\helpers\SiteUrl;

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


    public function create($form){
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'banner添加成功');
        }else{
            throw  new LogicException(-1,'banner添加失败');
        }
    }
    public function save($form){
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'banner修改成功');
        }else{
            throw new LogicException(-1,'banner修改失败');
        }
    }


    public function delete($form){
        $form['status'] = -1;
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'banner删除成功');
        }else{
            throw new LogicException(-1,'banner删除失败');
        }
    }

    public function info($data){
        $banner = $this->find(['id'=>$data['id']],'*');
        return $banner;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 2, $fields = '*')
    {
        $total = $this->get_total($where);
        $banner = $this->get_list($where, $limit, $offset, $fields);
        foreach ($banner as $k=>$ban){
            $banner[$k]['status_name'] = $ban['status']==0?'正常':'删除';
            if(!empty($ban['image_url'])){
                $list_images = explode(',',$ban['image_url']);
                $banner[$k]['image_url'] =SiteUrl::get_image_url($list_images[0]);
            }
        }

        return [$banner,$total['total']];
    }


}

##生成时间:2024-11-03 23:00:04 文件路径：E:\data\www\fish\web/../app//models/curd/Banner.php🐘