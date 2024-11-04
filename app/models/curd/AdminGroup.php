<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd;
use app\base\exception\LogicException;
use app\base\Model;
use app\helpers\Unique;

class AdminGroup extends Model
{
    public  $table='admin_group';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }

    public function create($data){
        $group_exits = $this->find(['name'=>$data['name']]);
        if($group_exits){
            throw  new  LogicException(-2,'管理员组已经存在');
        }
        $data['mids'] = '';
        $data['addtime'] = time();
        $res = $this->insert($data);
        if($res){
            throw new LogicException(0,'管理员组添加成功');
        }else{
            throw new LogicException(-1,'管理员组添加失败');
        }
    }

    public function save($data)
    {
        $group = $this->find(['id'=>$data['id']],'*');
        if(!$group){
            throw  new  LogicException(-2,'管理员组不存在');
        }
        if(!empty($data['name'])){
            $group['name'] = $data['name'];
        }
        if(!empty($data['comment'])){
            $group['comment'] = $data['comment'];
        }
        if(!empty($data['allow_mutil_login'])){
            $group['allow_mutil_login'] = $data['allow_mutil_login'];
        }
        if(!empty($data['mids'])){
            $group['mids'] = $data['mids'];
        }
        $res = $this->update($group,['id'=>$data['id']],1);
        if($res){
            throw new LogicException(0,'管理员组修改成功');
        }else{
            throw new LogicException(-1,'管理员组修改失败');
        }
    }

    public function delete($data){
        $user= $this->find(['username'=>$data['username']],'username,password,salt');
        if(!$user){
            throw  new  LogicException(-2,'管理员不存在');
        }
        $user['update_time'] = time();
        $user['status'] = -1;
        $res = $this->update($user,['username'=>$data['username']],1);
        if($res){
            throw new LogicException(0,'管理员修改成功');
        }else{
            throw new LogicException(-1,'管理员修改失败');
        }
    }

    public function info($data){
        $group = $this->find(['id'=>$data['id']],'*');
        return $group;
    }

    public function find_all_group($data){
        $data = array_filter($data);
        $group = $this->find_all($data);
        return $group;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 2, $fields = '*')
    {
        $total = $this->get_total($where);
        $users = $this->get_list($where,$limit,$offset,$fields);
        return [$users,$total['total']];
    }



}

##生成时间:2024-10-19 10:52:59 文件路径：E:\data\www\fish\web/../app//models/curd/AdminGroup.php🐘