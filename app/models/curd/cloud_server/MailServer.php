<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd\cloud_server;
use app\base\Model;
use app\base\exception\LogicException;
class MailServer extends Model
{
    public $db = 'cloud';
    public  $table='cs_mail_server';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }
    public function create($form){
        $form['addtime'] = time();
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'添加成功');
        }else{
            throw  new LogicException(-1,'添加失败');
        }
    }
    public function save($form){
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'修改成功');
        }else{
            throw new LogicException(-1,'修改失败');
        }
    }

    public function delete($form){
        $form['deltime'] = time();
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
            $data[$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
            $data[$k]['deltime'] = date('Y-m-d H:i:s',$v['deltime']);
            $data[$k]['expire_time'] = date('Y-m-d H:i:s',$v['expire_time']);
            $data[$k]['status'] = $this->get_config_status()[$v['status']]['name'];
            if(strpos($v['stmp_server'],'139')!=false){
                $data[$k]['mail_server'] = STATIC_URL.'images/mail/139.jpg';
                $data[$k]['mail_server_url'] = 'http://mail.139.com';
            }elseif (strpos($v['stmp_server'],'126')!=false){
                $data[$k]['mail_server'] = STATIC_URL.'images/mail/126.jpg';
                $data[$k]['mail_server_url'] = 'http://www.126.com';
            }elseif (strpos($v['stmp_server'],'qq')!=false){
                $data[$k]['mail_server'] = STATIC_URL.'images/mail/qq.jpg';
                $data[$k]['mail_server_url'] = 'http://mail.qq.com';
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

##生成时间:2024-11-29 21:11:05 文件路径：MailServer.php🐘