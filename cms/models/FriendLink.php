<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\models;
use base\exception\LogicException;
use base\Model;
use helpers\Tree;

class FriendLink extends Model
{
    public   $db = 'cms';
    public  $table='cms_friend_link';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }


    public function create($form){
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'友情链接添加成功');
        }else{
            throw  new LogicException(-1,'友情链接添加失败');
        }
    }
    public function save($form){
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'友情链接修改成功');
        }else{
            throw new LogicException(-1,'友情链接修改失败');
        }
    }


    public function delete($form){
        $form['status'] = -1;
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'友情链接删除成功');
        }else{
            throw new LogicException(-1,'友情链接删除成功');
        }
    }

    public function get_find_all(){
        $res = $this->find_all('',0,100);
        return $res;
    }


    public function info($data){
        $article_category = $this->find(['id'=>$data['id']],'*');
        return $article_category;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 2, $fields = '*')
    {
        $total = $this->get_total($where);
        $friend = $this->get_list($where, $limit, $offset, $fields);
        foreach ($friend as $k=>$f){
            $friend[$k]['status_name'] = $f['status']==0? '<span class="label btn-success" style="background-color: blue;" >正常</span>':'<span class="label btn-danger" style="background-color: red;" >删除</span>';
        }
        return [$friend,$total['total']];
    }

}

##生成时间:2024-11-03 12:24:39 文件路径：E:\data\www\fish\web/../app//models/curd/FriendLink.php🐘