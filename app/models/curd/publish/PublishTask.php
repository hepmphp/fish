<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd\publish;
use app\base\Model;
use app\base\exception\LogicException;
class PublishTask extends Model
{
    public $db = 'publish';
    public  $table='pub_publish_task';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }
    public function create($form){
        $form['admin_id'] = $_SESSION['admin_user_id'];
        $form['status'] = 1;
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'添加成功');
        }else{
            throw  new LogicException(-1,'添加失败');
        }
    }
    public function save_result($form){
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
           return true;
        }else{
           return  false;
        }
    }
    public function save($form){
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'任务修改成功');
        }else{
            throw new LogicException(-1,'任务修改失败');
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
        foreach ($data as $k=>$v){
            $data[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
            $data[$k]['status'] = $this->get_config_status()[$v['status']]['name'];
        }
        return [$data,$total['total']];
    }




    public static function get_config_status(){
            return [
                0=>['id'=>0,'name'=>'成功'],
				1=>['id'=>1,'name'=>'待同步'],
				2=>['id'=>2,'name'=>'同步失败'],
				3=>['id'=>3,'name'=>'还原中'],
				4=>['id'=>4,'name'=>'还原成功'],
				5=>['id'=>5,'name'=>'还原失败'],

            ];
    }


}#end

##生成时间:2024-11-19 11:38:06 文件路径：PublishTask.php🐘