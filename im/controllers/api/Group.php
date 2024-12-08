<?php

namespace im\controllers\api;

use im\base\ImController;
use im\base\exception\LogicException;
use im\helpers\Input;
use app\helpers\Validate;
use im\models\im\Group as M_Group;
use im\models\im\FriendGroup;

class Group extends ImController
{

    public $chat_group = '';
    public $friend_group = '';
    public function __construct()
    {
        $this->friend_group = new FriendGroup();
        $this->chat_group = new M_Group();
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

        $account = Input::get_post('account', '', 'trim');
        if ($account) {
            if (!Validate::required('account')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['account'] = $account;
        }

        $group_name = Input::get_post('group_name', '', 'trim');
        if ($group_name) {
            if (!Validate::required('group_name')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['group_name'] = $group_name;
        }

        $avatar = Input::get_post('avatar', '', 'trim');
        if ($avatar) {
            if (!Validate::required('avatar')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['avatar'] = $avatar;
        }

        $belong = Input::get_post('belong', '', 'trim');
        if ($belong) {
            if (!Validate::required('belong')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['belong'] = $belong;
        }

        $description = Input::get_post('description', '', 'trim');
        if ($description) {
            if (!Validate::required('description')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['description'] = $description;
        }

        $status = Input::get_post('status', '', 'trim');
        if ($status) {
            if (!Validate::required('status')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['status'] = $status;
        }

        $avatar = Input::get_post('avatar', '', 'trim');
        if ($avatar) {
            if (!Validate::required('avatar')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['avatar'] = $avatar;
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

        $update_time = Input::get_post('update_time', '', 'trim');
        if ($update_time) {
            if (!Validate::required('update_time')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['update_time'] = $update_time;
        }

        $delete_time = Input::get_post('delete_time', '', 'trim');
        if ($delete_time) {
            if (!Validate::required('delete_time')) {
                throw  new  LogicException(-1, '链接名称');
            }
            $where['delete_time'] = $delete_time;
        }


        $where = array_filter($where);
        return $where;
    }

    public function create()
    {
        $form = $this->get_search_where();
        $this->chat_group->create($form);

    }

    public function update()
    {
        $form = $this->get_search_where();
        $this->chat_group->save($form);
    }

    public function delete()
    {
        $form['id'] = Input::get_post('id', '', 'intval');
        if (!Validate::required($form['id'])) {
            throw  new LogicException(100, 'id不能为空');
        }
        $this->chat_group->delete($form);
    }

    public function get_list()
    {
        $where = $this->get_search_where();
        $page = Input::get_post('page', 1, 'intval');
        $per_page = Input::get_post('per_page', 20, 'intval');
        list($res, $total) = $this->chat_group->get_list_info($where, $page, $per_page, '*');
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


    public function get_group_member_list()
    {
        $belong_id = Input::get_post('belong_id',1,'trim');
        $friends = $this->friend_group->get_group_member_list(0);
        $data =[
            1=>[
                'username' => 'hepm',
                'id' => 1,
                'status' => 'online',
                'sign' => "在深邃的编码世界，做一枚轻盈的纸飞机",
                'avatar' => 'http://127.0.0.1/upload/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg'
            ],
            2=>[
                'username' => 'fish',
                'id' => 2,
                'status' => 'online',
                'sign' => "在知识的海洋徜徉",
                'avatar' => 'http://127.0.0.1/upload/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg'
            ],
            3=>[
                'username' => 'pink',
                'id' => 3,
                'status' => 'online',
                'sign' => "在知识的海洋徜徉",
                "avatar" => "http://127.0.0.1/upload/2024/12/05/f942f64553eef272e28f6fec8af8c1aa.jpg",
            ]
        ];
        $data_friend = [
            1 => [
                [
                    "id" => "1",
                    "username" => "hepm",
                    "avatar" => "http://127.0.0.1/upload/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg",
                    "sign" => "这些都是测试数据，实际使用请严格按照该格式返回"
                ],
                [
                    "username" => "fish",
                    "id" => "2",
                    "avatar" => "http://127.0.0.1/upload/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg",
                    "sign" => "微电商达人",
                ],
                [
                    "username" => "pink",
                    "id" => "3",
                    "avatar" => "http://127.0.0.1/upload/2024/12/05/f942f64553eef272e28f6fec8af8c1aa.jpg",
                    "sign" => "",
                ]
            ],
            2 => [
                [
                    "id" => "1",
                    "username" => "hepm",
                    "avatar" => "http://127.0.0.1/upload/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg",
                    "sign" => "这些都是测试数据，实际使用请严格按照该格式返回"
                ],
                [
                    "username" => "fish",
                    "id" => "2",
                    "avatar" => "http://127.0.0.1/upload/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg",
                    "sign" => "微电商达人",
                ],
                [
                    "username" => "pink",
                    "id" => "3",
                    "avatar" => "http://127.0.0.1/upload/2024/12/05/f942f64553eef272e28f6fec8af8c1aa.jpg",
                    "sign" => "",
                ]
            ],
            3 => [
                [
                    "id" => "1",
                    "username" => "hepm",
                    "avatar" => "http://127.0.0.1/upload/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg",
                    "sign" => "这些都是测试数据，实际使用请严格按照该格式返回"
                ],
                [
                    "username" => "fish",
                    "id" => "2",
                    "avatar" => "http://127.0.0.1/upload/2024/12/05/6754a011395cffd2a0ff2e872f394bc1.jpg",
                    "sign" => "微电商达人",
                ],
                [
                    "username" => "pink",
                    "id" => "3",
                    "avatar" => "http://127.0.0.1/upload/2024/12/05/f942f64553eef272e28f6fec8af8c1aa.jpg",
                    "sign" => "",
                ]
            ],
        ];
        $data_group = array(
            'id'=>1,
            "avatar" => "http://127.0.0.1/upload/2024/12/05/f942f64553eef272e28f6fec8af8c1aa.jpg",
            'groupname'=>'宇宙之神',
            'list'=>$data_friend[$belong_id],
            'status'=>0
        );
            $data['mine'] = $data[$belong_id];
            $friends = array_merge($friends,[$data_group]);
            $data['friend'] = $friends;
            Input::ajax_return(0, '获取数据成功', $data);

    }

    public function get_group_list(){
        $where = $this->get_search_where();
        $where['status'] = 0;
        $data= $this->chat_group->get_group_list($where);
        if($data){
            Input::ajax_return(0,'获取数据成功',$data);
        }else{
            throw new LogicException(100,'没有数据');
        }
    }
}