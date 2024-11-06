<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace bbs\models;
use app\helpers\Input;
use bbs\base\Model;
use bbs\base\exception\LogicException;

class Posts extends Model
{
    public $db ='bbs';
    public  $table='bbs_posts';
    public  $db_prefix='';

    public $forum = '';


    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        $this->forum = new Forum();
        parent::__construct();
    }
    public function create($form){
        $forum = $this->forum->info(['id'=>$form['fid']]);
        $form['forum_name'] = $forum['name'];
        $form['created_time'] = time();
        $form['user_id'] = 1;
        $form['username'] = 'fish';
        $form['ip'] = Input::get_client_ip();
        $form['status']  = 0 ;
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'添加成功');
        }else{
            throw  new LogicException(-1,'添加失败');
        }
    }
    public function save($form){
        $reply = $this->info(['id'=>$form['id']]);
        $form['pid'] = $reply['pid'];
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'修改成功');
        }else{
            throw new LogicException(-1,'修改失败');
        }
    }

    public function delete($form){
        $form['status'] = -1;
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'删除成功');
        }else{
            throw new LogicException(-1,'删除成功');
        }
    }

    public function info($data){
        $info = $this->find(['id'=>$data['id']],'*');
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        return [$data,$total['total']];
    }




    public static function get_config_status(){
        return [
            0=>['id'=>0,'name'=>'正常'],
            -1=>['id'=>-1,'name'=>'删除'],

        ];
    }


}#end

##生成时间:2024-11-05 23:20:20 文件路径：Posts.php🐘