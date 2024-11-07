<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace bbs\models;
use app\helpers\Arr;
use app\helpers\Input;
use bbs\base\Model;
use bbs\base\exception\LogicException;
use bbs\models\User;

class Posts extends Model
{
    public $db ='bbs';
    public  $table='bbs_posts';
    public  $db_prefix='';
    public $forum = '';
    public $user = '';
    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        $this->forum = new Forum();
        $this->user = new User();
        parent::__construct();
    }
    public function create($form){
        $forum = $this->forum->info(['id'=>$form['fid']]);
        $form['forum_name'] = $forum['name'];
        $form['created_time'] = time();
        $form['user_id'] = $_SESSION['bbs_user_id'];
        $form['username'] = $_SESSION['bbs_user_username'];
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
        $user_ids = Arr::getColumn($data,'user_id');
        if(!empty($user_ids)){
            $where_user_id['id'] = $user_ids;
            $users = $this->user->find_all($where_user_id,1,1000);
            $user_index = Arr::index($users,'id');
            foreach ($data as $k=>$v){
                if(isset($user_index[$v['user_id']])){
                    $data[$k]['avator'] = $user_index[$v['user_id']]['avator'];
                }else{
                    $data[$k]['avator'] = '';
                }
            }
        }
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