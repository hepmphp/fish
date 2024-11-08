<?php
/**
 *  fiename: fish/File.php$🐘
 *  date:  2024/11/8   16:19$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\cms;
use app\base\BaseController;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\Folder;
use app\models\curd\File as M_File;
class File extends  BaseController{
    public $folder = array();
    public $file = array();
    public function __construct(){
        parent::__construct();
        $this->folder = new Folder();
        $this->file = new M_File();
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

        $user_id = Input::get_post('user_id', '', 'trim');
        if ($user_id) {
            if (!Validate::required('user_id')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['user_id'] = $user_id;
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

        $start_time = Input::get_post('start_time', '', 'trim');
        $end_time = Input::get_post('end_time', '', 'trim');

        if (!empty($start_time)) {
            if (!Validate::required('start_time')) {
                throw  new  LogicException(-1, '请输入开始时间');
            }
            $where['addtime > '] = strtotime($start_time);
        }
        if (!empty($end_time)) {
            if (!Validate::required('end_time')) {
                throw  new  LogicException(-1, '请输入结束时间');
            }
            $where['addtime < '] = strtotime($end_time);
        }


        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $folders = $this->folder->find_all(['status'=>0],1,1000,'id,parentid as pId,name');
        $this->view->assign('folders',$folders);
        $this->view->display('cms/file/index');
    }

    public function detail(){
        $form = $this->get_search_where();
        $config_folder_id = $this->folder->get_config_menu([]);
        $this->view->assign('form', $form);
        $this->view->assign('config_folder_id', $config_folder_id);
        $this->view->display('cms/file/detail');
    }

    public function folder(){
        $form = $this->get_search_where();
        $page = Input::get_post('page','1','intval');
        $per_page = Input::get_post('per_page',200,'intval');
        list($res,$total) = $this->file->get_list_info($form,$page,$per_page,'*');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;

        $config_folder_id = $this->folder->get_config_menu([]);
        $this->view->assign('form', $form);
        $this->view->assign('data', $data);
        $this->view->assign('config_folder_id', $config_folder_id);
        $this->view->display('cms/file/folder');
    }

    public function create()
    {
        $form = $this->get_search_where();
        $config_folder_id = $this->folder->get_config_menu([]);
        $this->view->assign('form', $form);

        $this->view->assign('config_folder_id', $config_folder_id);
        $this->view->display('cms/file/create');
    }

    public function update()
    {
        $form = $this->get_search_where();
        $form = $this->file->info(['id'=>$form['id']]);
        $config_folder_id = $this->folder->get_config_menu(['id'=>$form['id']]);
        $this->view->assign('form', $form);
        $this->view->assign('config_folder_id', $config_folder_id);
        $this->view->display('cms/file/create');
    }

    public function delete()
    {

    }

    public function info()
    {
        $form = $this->get_search_where();
        $this->view->assign('form', $form);
        $this->view->display('cms/file/info');
    }
}

