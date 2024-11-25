<?php

namespace app\controllers\cloud;
use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\cloud_server\ServerManager as M_ServerManager;
use app\helpers\Validate;
 class ServerManager extends BaseController{

     public $cs_server_manager  = '';
     public function __construct()
     {
         $this->cs_server_manager = new M_ServerManager();
         parent::__construct();
     }

    public function get_search_where(){
         $where = array();
        
        $id = Input::get_post('id','','trim');
        if($id){
          if(!Validate::required('id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['id'] = $id;
        }
            
        $host = Input::get_post('host','','trim');
        if($host){
          if(!Validate::required('host')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['host'] = $host;
        }
            
        $port = Input::get_post('port','','trim');
        if($port){
          if(!Validate::required('port')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['port'] = $port;
        }
            
        $username = Input::get_post('username','','trim');
        if($username){
          if(!Validate::required('username')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['username'] = $username;
        }
            
        $password = Input::get_post('password','','trim');
        if($password){
          if(!Validate::required('password')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['password'] = $password;
        }
            
        $start_time = Input::get_post('start_time','','trim');
        $end_time = Input::get_post('end_time','','trim');
       
        if(!empty($start_time)){
            if(!Validate::required('start_time')){
                   throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['start_time > '] =strtotime($start_time);
        }
        if(!empty($end_time)){
            if(!Validate::required('end_time')){
                   throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['end_time < '] = strtotime($end_time);
        }
           
        $start_time = Input::get_post('start_time','','trim');
        $end_time = Input::get_post('end_time','','trim');
       
        if(!empty($start_time)){
            if(!Validate::required('start_time')){
                   throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['start_time > '] =strtotime($start_time);
        }
        if(!empty($end_time)){
            if(!Validate::required('end_time')){
                   throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['end_time < '] = strtotime($end_time);
        }
           
        $deltime = Input::get_post('deltime','','trim');
        if($deltime){
          if(!Validate::required('deltime')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['deltime'] = $deltime;
        }
            
        $status = Input::get_post('status','','trim');
        if($status){
          if(!Validate::required('status')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['status'] = $status;
        }
            

        $where = array_filter($where);
        return $where;
    }

     public function index(){
         $data = $this->get_search_where();
         $data['admin_url'] = '/cloud/server_manager/index?iframe=1';
         $this->view->assign('data',$data);
         $config_status = $this->cs_server_manager->get_config_status();
         $this->view->assign('config_status',$config_status);

         if(isset($_GET['iframe']) && $_GET['iframe']==1){
             $this->view->display('cloud_server/cs_server_manager/index');
         }else{
             $this->view->display('admin/root/admin_iframe');
         }
     }

     public function create(){
         $form = $this->get_search_where();
		 $config_status = $this->cs_server_manager->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('cloud_server/cs_server_manager/create');
     }

     public function update(){
         $form = $this->get_search_where();
         $form = $this->cs_server_manager->info(['id'=>$form['id']]);
		 $config_status = $this->cs_server_manager->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('cloud_server/cs_server_manager/create');
     }

     public function delete(){

     }

     public function info(){
         $form = $this->get_search_where();
         $this->view->assign('form',$form);
         $this->view->display('cloud_server/cs_server_manager/info');
     }

     public function server_status(){
         $form = $this->get_search_where();
         $form['is_change_user'] = 1;
         $form_cmd['cmd_uptime_p'] = 'uptime -p|awk \'{printf "%s,%s,%s,%s,%s,%s,%s,%s,%s,%s \n",$1,$2,$3,$4,$5,$6,$7,$8,$9,$10}\'';
         $form_cmd['cmd_df_h'] = 'df -h|awk \'{printf "%s,%s,%s,%s,%s,%s,%s,%s,%s,%s \n",$1,$2,$3,$4,$5,$6,$7,$8,$9,$10}\'';
         $form_cmd['cmd_free_h'] = 'free -h|awk \'{printf "%s,%s,%s,%s,%s,%s,%s,%s,%s,%s \n",$1,$2,$3,$4,$5,$6,$7,$8,$9,$10}\'';
         $form_cmd['cmd_cpu_mem']  = 'ps axu|sort -r -k3 |head -n 20|awk  '.'\'NR==1{ printf("%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s\n", $1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11)};NR>1 { printf("%s,%s,%s,%s,%sMB,%sMB,%s,%s,%s,%s,%s\n", $1,$2,$3,$4,$5/1024,$6/1024,$7,$8,$9,$10,$11) }\'';
         $form_cmd['cmd'] = 'ps aux|ps aux|awk \'{printf "%s,%s,%s,%s,%s,%s,%s,%s,%s,%s \n",$1,$2,$3,$4,$5,$6,$7,$8,$9,$10}\'';

//         $this->send_to_socket($form);
         $this->view->assign('form',$form);
         $this->view->assign('form_cmd',$form_cmd);
         $this->view->display('cloud_server/cs_server_manager/server_status');
     }
     public function mysql(){
         $this->view->display('cloud_server/cs_server_manager/mysql');

     }

     public function redis(){
         $host = isset($_GET["host"]) ? $_GET["host"] : '172.18.0.1';
         $db = isset($_GET["db"]) ? $_GET["db"] : 0;
         $port = isset($_GET["port"]) ? $_GET["port"] : 6379;
         $reids = new \Redis();
         $reids->connect($host, $port, 5);
         try {
             $reids->ping();
         } catch (Exception $e) {
             die("Couldn't connect to server [tcp://{$host}:{$port}]. " . $e->getMessage());
         }
         $reids->select($db);
         $all_keys = $reids->keys('*');
         $this->view->assign('all_keys',$all_keys);
         $this->view->display('cloud_server/cs_server_manager/redis');
     }
     public function redis_info(){
         $host = Input::get_post('host','','trim');
         $port = Input::get_post('port','','trim');
         $reids = new \Redis();
         $reids->connect($host, $port, 5);
         $info = $reids->info();
         $this->view->assign('info',$info);
         $this->view->display('cloud_server/cs_server_manager/redis_info');
     }

     public function redis_edit(){
         $form['host'] = Input::get_post('host','','trim');
         $form['port']= Input::get_post('port','','trim');
         $form['db'] = Input::get_post('db','','trim');
         $form['data_type'] = Input::get_post('data_type','','trim');
         $form['redis_key'] = Input::get_post('redis_key','','trim');
         $redis = new \Redis();
         $redis->connect( $form['host'] ,   $form['port'], 5);
         $redis->select($form['db']);
         $form['redis_value'] = $redis->get($form['redis_key']);
         $this->view->assign('form',$form);
         $this->view->display('cloud_server/cs_server_manager/redis_edit');
     }



     public function redis_update(){
         $form['host'] = Input::get_post('host','','trim');
         $form['port']= Input::get_post('port','','trim');
         $form['db'] = Input::get_post('db','','trim');
         $form['data_type'] = Input::get_post('data_type','','trim');
         $form['redis_key'] = Input::get_post('redis_key','','trim');
         $form['redis_value'] = Input::get_post('redis_value','','trim');
         $redis = new \Redis();
         $redis->connect( $form['host'] ,   $form['port'], 5);
         $redis->select($form['db']);
         $redis->del($form['redis_key']);
         if($form['data_type']=='zset'){
             $redis->zAdd($form['redis_key'],$form['redis_value']);
         }elseif($form['data_type']=='list'){
             $redis->lPush($form['redis_key'], $form['redis_value']);
         }elseif($form['data_type']=='set'){
             $redis->sAdd($form['redis_key'], $form['redis_value']);
         }elseif($form['data_type']=='hash'){
             $redis->hMSet($form['redis_key'],$form['redis_value']);
         }else{
             $redis->set($form['redis_key'],$form['redis_value'],864000);
         }
         Input::ajax_return(0,'数据更改成功',$form);
     }

     public function ftp(){
         $this->view->display('cloud_server/cs_server_manager/ftp');
     }
 }