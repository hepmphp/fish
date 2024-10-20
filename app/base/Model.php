<?php
/**
 *  fiename: fish/Model.php$🐘
 *  date: 2024/10/18 11:55:28$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace base;

use db\SqlQueryBuilder;
use helpers\Debug;

class Model
{
    public $db;
    public $table = '';
    public $db_prefix = '';
    public $pkey = 'id';
    public $relate_models = array();
    public $sql_query_builder = '';

    public static $debug_table_data;

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
        $this->debug($sql);
        $res = $this->db->fetch($sql);
        $this->debug_table($res);
        return  $res;
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
        $this->debug($sql);
        $res = $this->db->fetch_all($sql);
        $this->debug_table($res);
        return $res;
    }

    /**
     * 新增数据
     * @param $data 数据数组
     * @return mixed
     */
    public function insert($data)
    {
        $sql = $this->sql_query_builder->table($this->table)->insert($data);
        $this->debug($sql);
        return $this->db->exec($sql);

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
        $this->debug($sql);
        return $this->db->exec($sql);
    }

    /**
     * 删除数据
     * @param $where 条件
     * @return mixed
     */
    public function delete($where)
    {
        $sql = $this->sql_query_builder->table($this->table)->limit(1)->delete($where);
        $this->debug($sql);
        return $this->db->exec($sql);
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
        $this->debug($sql);
        $res = $this->db->fetch_all($sql);
        $this->debug_table($res);
        return $res;
    }

    /**
     * 统计数量
     * @param array $where
     * @return mixed
     */
    public function get_total($where = array())
    {
        $sql = $this->sql_query_builder->table($this->table)->where($where)->count();
        $this->debug($sql);
        $res = $this->db->count($sql);
        $this->debug_table($res);
        return $res;
    }

    public function get_last_sql()
    {
        return $this->sql_query_builder->get_last_sql();
    }

    public function debug($sql){
        if(DEBUG){
            Debug::db_log($sql);
            Debug::console_log($sql);
//            Debug::debug_table($sql);
        }
    }
    public function debug_table($data){
        self::$debug_table_data[] = $data;
    }

    public function __destruct()
    {
        if(DEBUG) {
            Debug::console_log_table(self::$debug_table_data);
//            Debug::console_log_table(get_included_files());
        }
    }

}
