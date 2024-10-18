<?php
/**
 *  fiename: fish/Model.php$🐘
 *  date: 2024/10/18 11:55:28$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace base;

use db\SqlQueryBuilder;

class Model
{
    public $db;
    public $table = '';
    public $db_prefix = '';
    public $pkey = 'id';
    public $relate_models = array();
    public $sql_query_builder = '';

    public function __construct()
    {
        $this->db = App::get_db();
        $this->sql_query_builder = new SqlQueryBuilder();
    }

    /**
     * 处理只提供主键的情况
     *
     * @param string|array|int $condition 条件
     * @return string|array
     */
    protected function pkey_condition($condition)
    {
        if (is_numeric($condition)) {  // 主键
            $condition = array(static::$pkey => $condition);
        }
        return $condition;
    }

    /***
     *  用法
     *  $passenger = $m_passenger->find(array('id'=>1),'passenger');//取某一列
     *  $passenger = $m_passenger->find(array('id'=>1));//取所有列
     * @param $where
     * @param string $fields
     * @return mixed
     */
    public function find($where, $fields = '*')
    {
        $sql = $this->sql_query_builder->table($this->table)->field($fields)->limit(1)->where($where)->fetch();
        return $this->db->fetch($sql);
    }

    /***
     * 用法
     *   $passengers = $m_passenger->find_all(['id[>]'=>1,'LIMIT'=>10],'passenger');//取某一列
     *   $passengers = $m_passenger->find_all(['id[>]'=>1,'LIMIT'=>10]);//取所有列
     * @param $where
     * @param string $fields
     * @return mixed
     */
    public function find_all($where, $limit, $offset, $fields = '*')
    {
        $sql = $this->sql_query_builder
            ->table($this->table)
            ->field($fields)
            ->where($where)
            ->limit($limit, $offset)
            ->fetch_all();
        return $this->db->fetch_all($sql);
    }

    /**
     * 新增数据
     * @param $data 数据数组
     * @return mixed
     */
    public function insert($data)
    {
        $sql = $this->sql_query_builder->table($this->table)->insert($data);
        return $this->insert($data);
    }

    /**
     * 修改数据
     * @param $data  数据数组
     * @param $where 条件
     * @return mixed
     */
    public function update($data, $where, $limit = 1)
    {
        $sql = $this->sql_query_builder->table($this->table)->limit($limit)->update($data, $where);
        return $this->db->update($sql);
    }

    /**
     * 删除数据
     * @param $where 条件
     * @return mixed
     */
    public function delete($where)
    {
        $sql = $this->sql_query_builder->table($this->table)->limit(1)->delete($where);
        return $this->db->delete($sql);
    }

    /**
     * 获取列表数据
     * @param array $where
     * @param int $per_page
     * @param int $offset
     */
    public function get_list($where = array(), $limit = 1, $offset = 100, $fields = '*')
    {
        $sql = $this->sql_query_builder->table($this->table)->field($fields)->where($where)->limit($limit, $offset)->fetch_all();
        return $this->db->fetch_all($sql);
    }

    /**
     * 统计数量
     * @param array $where
     * @return mixed
     */
    public function get_total($where = array())
    {
        $sql = $this->sql_query_builder->table($this->table)->where($where)->count();
        return $this->db->count($sql);
    }

    public function get_last_sql()
    {
        return $this->sql_query_builder->get_last_sql();
    }

}
