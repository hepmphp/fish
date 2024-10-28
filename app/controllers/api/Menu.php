<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/19 18:56:31$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\api;
use base\exception\LogicException;
use helpers\Input;
use helpers\Validate;
use helpers\Debuger;
use models\curd\AdminMenu;
use models\curd\AdminUser;

class Menu extends \base\BaseController{
    
    public $admin_menu;
    
    public function __construct()
    {
        $this->admin_menu = new AdminMenu();
    }


    public function get_search_where(){
         $where['model'] = Input::get_post('model');
         $start_time = Input::get_post('start_time');
         $end_time = Input::get_post('end_time');
         if(!empty($start_time)){
             $where['create_time>'] =strtotime($start_time);
         }
         if(!empty($end_time)){
             $where['create_time<'] = strtotime($end_time);
         }
        $where = array_filter($where);
        if(empty($where)){
            $where = '';
        }
         return $where;
    }

    public function create(){
        $form['id'] = Input::get_post('id');
        $form['parentid'] = Input::get_post('parentid');
        $form['name'] = Input::get_post('name');
        $form['model'] = Input::get_post('model');
        $form['action'] = Input::get_post('action');
        $form['data'] = Input::get_post('data');
        $form['listorder'] = Input::get_post('listorder');
        $form['remark'] = Input::get_post('remark');
        $form['status'] = Input::get_post('status');
        $this->admin_menu->create($form);
    }
    public function update(){
        $form['id'] = Input::get_post('id');
        $form['parentid'] = Input::get_post('parentid');
        $form['name'] = Input::get_post('name');
        $form['model'] = Input::get_post('model');
        $form['action'] = Input::get_post('action');
        $form['data'] = Input::get_post('data');
        $form['listorder'] = Input::get_post('listorder');
        $form['remark'] = Input::get_post('remark');
        $form['status'] = Input::get_post('status');
        $this->admin_menu->save($form);

    }
    public function delete(){
        $form['id'] = Input::get_post('id');
        $this->admin_menu->delete($form);
    }


    public function info(){

    }

    public function get_list(){
        $where = $this->get_search_where();

        $page = Input::get_post('page');
        $per_page = Input::get_post('per_page');
        list($res,$total) = $this->admin_user->get_list_info($where,$per_page,$page,'*');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        if($res){
            Input::ajax_return(0,'获取数据成功',$data);
        }else{
            throw new LogicException(100,'没有数据');
        }
    }



}
