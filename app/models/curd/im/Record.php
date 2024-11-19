<?php
/**
 *  fiename: fish/Record.php$🐘
 *  date:  2024/11/17   22:17$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\models\curd\im;

use app\base\Model;
use app\base\exception\LogicException;

class Record extends Model
{
    public $db = 'im';
    public $table = 'chat_record';
    public $db_prefix = '';

    public function __construct()
    {
        $this->table = $this->db_prefix . $this->table;
        parent::__construct();
    }

    public function create($form)
    {
        $res = $this->insert($form);
        if ($res) {
            throw  new LogicException(0, '添加成功');
        } else {
            throw  new LogicException(-1, '添加失败');
        }
    }

    public function save($form)
    {
        $res = $this->update($form, ['id' => $form['id']], 1);
        if ($res) {
            throw new LogicException(0, '修改成功');
        } else {
            throw new LogicException(-1, '修改失败');
        }
    }

    public function delete($form)
    {
        $form['status'] = -1;
        $res = $this->update($form, ['id' => $form['id']], 1);
        if ($res) {
            throw new LogicException(0, '删除成功');
        } else {
            throw new LogicException(-1, '删除成功');
        }
    }

    public function info($data)
    {
        $info = $this->find(['id' => $data['id']], '*');
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        foreach ($data as $k=>$v){
            $data[$k]['status'] = $v['status']=='0'?'正常':'<span style="color:red;">删除</span>';
            $data[$k]['type'] = $this->get_config_type()[$v['type']]['name'];
        }
        return [$data, $total['total']];
    }

    public static function get_config_type(){
        return [
            0=>['id'=>0,'name'=>'聊天'],
            1=>['id'=>1,'name'=>'群聊'],

        ];
    }

    public static function get_config_status()
    {
        return [
            0 => ['id' => 0, 'name' => '正常'],
            -1 => ['id' => -1, 'name' => '删除'],

        ];
    }


}#end

##生成时间:2024-11-17 22:17:03 文件路径：Record.php🐘