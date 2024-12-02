<?php
/**
 *  fiename: fish/Folder.php$🐘
 *  date:  2024/12/2   12:22$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */


namespace doc\controllers\api;

use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use doc\models\doc\Folder as M_Folder;
use doc\base\DocController;

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

    public function create()
    {
        $form = $this->get_search_where();
        $this->doc_folder->create($form);

    }

    public function update()
    {
        $form = $this->get_search_where();
        $this->doc_folder->save($form);
    }

    public function delete()
    {
        $form['id'] = Input::get_post('id', '', 'intval');
        if (!Validate::required($form['id'])) {
            throw  new LogicException(100, 'id不能为空');
        }
        $this->doc_folder->delete($form);
    }

    public function get_list()
    {
        $where = $this->get_search_where();
        $page = Input::get_post('page', 1, 'intval');
        $per_page = Input::get_post('per_page', 20, 'intval');
        list($res, $total) = $this->doc_folder->get_list_info($where, $page, $per_page, '*');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] = $page;
        $data['per_page'] = $per_page;
        if ($res) {
            Input::ajax_return(0, '获取数据成功', $data);
        } else {
            throw new LogicException(100, '没有数据');
        }
    }
}