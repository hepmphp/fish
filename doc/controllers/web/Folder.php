<?php
/**
 *  fiename: fish/Folder.php$🐘
 *  date:  2024/12/2   12:21$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */


namespace doc\controllers\web;

use doc\base\DocController;
use app\helpers\Input;
use doc\models\doc\Folder as M_Folder;
use app\helpers\Validate;


class Folder extends DocController
{

    public $doc_folder = '';

    public function __construct()
    {
        $this->doc_folder = new M_Folder();
        parent::__construct();
    }

    public function get_search_where()
    {
        $where = array();

        $id = Input::get_post('id', '', 'trim');
        if ($id) {
            if (!Validate::required('id')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['id'] = $id;
        }
        $folder_id = Input::get_post('folder_id', '', 'trim');
        if ($folder_id) {
            if (!Validate::required('folder_id')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['folder_id'] = $folder_id;
        }

        $name = Input::get_post('name', '', 'trim');
        if ($name) {
            if (!Validate::required('name')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['name'] = $name;
        }

        $parentid = Input::get_post('parentid', '', 'trim');
        if ($parentid) {
            if (!Validate::required('parentid')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['parentid'] = $parentid;
        }

        $start_time = Input::get_post('start_time', '', 'trim');
        $end_time = Input::get_post('end_time', '', 'trim');

        if (!empty($start_time)) {
            if (!Validate::required('start_time')) {
                throw  new  LogicException(-1, '请输入开始时间');
            }
            $where['start_time > '] = strtotime($start_time);
        }
        if (!empty($end_time)) {
            if (!Validate::required('end_time')) {
                throw  new  LogicException(-1, '请输入结束时间');
            }
            $where['end_time < '] = strtotime($end_time);
        }

        $user_id = Input::get_post('user_id', '', 'trim');
        if ($user_id) {
            if (!Validate::required('user_id')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['user_id'] = $user_id;
        }

        $status = Input::get_post('status', '', 'trim');
        if ($status) {
            if (!Validate::required('status')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['status'] = $status;
        }


        $where = array_filter($where);
        return $where;
    }

    public function index()
    {
        $this->view->display('doc/index/index');
    }

    public function create()
    {
        $form = $this->get_search_where();
        $form['id'] = 0;
        $form['parentid'] = 0;
        if($form['folder_id']){
            $form['parent_id'] = $form['folder_id'];
        }
        $form['name'] = '';
        $form['select_tree'] = '';
        $form['status'] = 0;
        $config_status = $this->doc_folder->get_config_status();
        $this->view->assign('config_status', $config_status);
        $this->view->assign('form', $form);
        $this->view->display('doc/web/folder/create');
    }

    public function update()
    {
        $form = $this->get_search_where();
        $form = $this->doc_folder->info(['id' => $form['id']]);
        if($form['parentid']){
            $form['parent_id'] = $form['parentid'];
        }
        $form['select_tree'] = $this->doc_folder->find_all([],0,1000);
        $config_status = $this->doc_folder->get_config_status();
        $this->view->assign('config_status', $config_status);

        $this->view->assign('form', $form);
        $this->view->display('doc/web/folder/create');
    }

    public function delete()
    {

    }

    public function info()
    {
        $form = $this->get_search_where();
        $this->view->assign('form', $form);
        $this->view->display('doc/doc_folder/info');
    }
}