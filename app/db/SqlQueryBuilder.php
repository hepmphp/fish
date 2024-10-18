<?php
/**
 *  fiename: fish/SqlQueryBuilder.php$🐘
 *  date: 2024/10/18 11:48:58$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace db;

class SqlQueryBuilder
{
    private $field='*';
    private $table;
    private $where;
    private $orderby;
    private $groupby;
    private $having;
    private $limit;
    private static $last_sql;
   //private static $db;
    private static $_instances = array();

    public function __construct()
    {
       // self::$db = PdoHelper::get_instance($configs);
    }
    public function field($field)
    {
        $this->field = $field;
        return $this;
    }
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }
    public function where($where)
    {
        if (is_string($where)) {
            $this->where = " WHERE ".$where;
        } else {
            $this->where =  " WHERE ".$this->data_implode($where);
        }
        return $this;
    }
    /**
     * 排序
     * @param $orderby  id desc,time asc
     * @return $this
     */
    public function order_by($orderby)
    {
        $this->orderby = " ORDER BY " . $orderby;
        return $this;
    }
    /**
     * 分组
     * @param $groupby  userid,reg_time
     * @return $this
     */
    public function group_by($groupby)
    {
        $this->groupby = " GROUP BY " . $groupby;
        return $this;
    }
    /**
     * 分组过滤
     * @param $having
     * @return $this
     */
    public function having($having)
    {
        $this->having = " Having " . $having;
        return $this;
    }
    /**
     * 分页
     * @param $offset
     * @param $limit
     * @return $this
     */
    public function limit()
    {
        $param = func_get_args();
        if(func_num_args()==1){
            $this->limit = " LIMIT $param[0]";
        }else{
            $this->limit = " LIMIT {$param[0]},{$param[1]}";
        }
        func_num_args();

        return $this;
    }
    /**
     * 生成sql
     * @return string
     */
    public function sql()
    {
        $sql_tpl = "SELECT %s FROM %s  %s";
        $sql = sprintf($sql_tpl, $this->field, $this->table, $this->where);
        //group %s having limit xxx
        if (!empty($this->groupby)) {
            $sql .= $this->groupby;
        }
        if (!empty($this->order)) {
            $sql .= $this->order;
        }
        if (!empty($this->having)) {
            $sql .= $this->having;
        }
        if (!empty($this->limit)) {
            $sql .= $this->limit;
        }
        //重置sql
        $this->field = null;
        $this->table = null;
        $this->orderby = null;
        $this->groupby = null;
        $this->having = null;
        $this->limit = null;
        return $sql;
    }
    public function count(){
        $sql_tpl = "SELECT count(*) FROM %s  %s";
        $sql = sprintf($sql_tpl, $this->table, $this->where);
        return $sql;
    }
    public function fetch(){
        $sql = $this->sql();
        self::$last_sql[] = $sql;
       // $one =  self::$db->fetch($sql);
        return $sql;
    }
    public function fetch_all(){
        $sql = $this->sql();
        self::$last_sql[] = $sql;
     //   $all = self::$db->fetchAll($sql);
        return $sql;
    }
    public function get_last_sql(){
        return self::$last_sql;
    }
    public function delete($where,$limit=1)
    {
        $this->where($where);
        $sql_tpl = "DELETE FROM %s where %s limit %s";
        $sql = sprintf($sql_tpl, $this->table, $this->where,$limit);
        self::$last_sql[] = $sql;
        //$res = self::$db->exec($sql);
        return $sql;
    }
    public function update($data,$where=array())
    {
        $this->where($where);
        $fields = array();
        foreach ($data as $key => $value)
        {
            preg_match('/([\w]+)(\[(\+|\-|\*|\/)\])?/i', $key, $match);
            if (isset($match[3]))
            {
                if (is_numeric($value))
                {
                    $fields[] = $this->column_quote($match[1]) . ' = ' . $this->column_quote($match[1]) . ' ' . $match[3] . ' ' . $value;
                }
            }
            else
            {
                $column = $this->column_quote($key);
                switch (gettype($value))
                {
                    case 'NULL':
                        $fields[] = $column . ' = NULL';
                        break;
                    case 'array':
                        preg_match("/\(JSON\)\s*([\w]+)/i", $key, $column_match);
                        $fields[] = $column . ' = ' . $this->quote(
                                isset($column_match[0]) ? json_encode($value) : serialize($value)
                            );
                        break;
                    case 'boolean':
                        $fields[] = $column . ' = ' . ($value ? '1' : '0');
                        break;
                    case 'integer':
                    case 'double':
                    case 'string':
                        $fields[] = $column . ' = ' . $this->fn_quote($key, $value);
                        break;
                }
            }
        }
        $sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $fields) .$this->where;
        self::$last_sql[]  = $sql;
       // return self::$db->exec($sql);
        return $sql;
    }
    public function insert($datas)
    {
        $lastId = array();
        // Check indexed or associative array
        if (!isset($datas[0])) {
            $datas = array($datas);
        }
        foreach ($datas as $data) {
            $values = array();
            $columns = array();
            foreach ($data as $key => $value) {
                array_push($columns, $this->column_quote($key));
                switch (gettype($value)) {
                    case 'NULL':
                        $values[] = 'NULL';
                        break;
                    case 'array':
                        preg_match("/\(JSON\)\s*([\w]+)/i", $key, $column_match);
                        $values[] = isset($column_match[0]) ?
                            $this->quote(json_encode($value)) :
                            $this->quote(serialize($value));
                        break;
                    case 'boolean':
                        $values[] = ($value ? '1' : '0');
                        break;
                    case 'integer':
                    case 'double':
                    case 'string':
                        $values[] = $this->fn_quote($key, $value);
                        break;
                }
            }
            $sql = 'INSERT INTO ' . $this->table . '(' . implode(', ', $columns) . ') VALUES (' . implode($values, ', ') . ')';
            self::$last_sql[]  = $sql;
            //self::$db->exec($sql);
            //$lastId[] = self::$db->lastInsertId();
        }
        //return count($lastId) > 1 ? $lastId : $lastId[0];
        return $sql;
    }
    protected function fn_quote($column, $string)
    {
        return (strpos($column, '#') === 0 && preg_match('/^[A-Z0-9\_]*\([^)]*\)$/', $string)) ?
            $string :
            $this->quote($string);
    }
    /***
     * 字段处理
     * @param $string
     * @return mixed
     */
    protected function column_quote($string)
    {
        //return '"' . str_replace('.', '"."', preg_replace('/(^#|\(JSON\))/', '', $string)) . '"';
        return str_replace('.', '"."', preg_replace('/(^#|\(JSON\))/', '', $string));
    }
    public function quote($string)
    {
        return $string;
      //  return self::$db->quote($string);
    }
    /**
     * Tests whether the string has an SQL operator
     *
     * @access    private
     * @param    string
     * @return    bool
     */
    public function has_operator($str)
    {
        $str = trim($str);
        if (!preg_match("/(\s|<|>|!|=|is null|is not null)/i", $str)) {
            return FALSE;
        }
        return TRUE;
    }
    /**
     *
     * @param $data   条件数组    ['id'=>2] ['id[<]'=>5]
     * @param $conjunctor 连接符号 AND
     * @param null $outer_conjunctor
     * @return string
     */
    public function data_implode($data, $conjunctor = 'AND')
    {
        $wheres = array();
        foreach ($data as $key => $value) {
            $type = gettype($value); //获取类型
            $column = $key;
            switch ($type) {
                case 'NULL':
                    $wheres[] = $column . ' IS NULL'; //['id'=>'']
                    break;
                case 'array':
                    $wheres[] = $column . ' IN (' . $this->array_quote($value) . ')'; //['id'=>[1,2,3,4,,5]]
                    break;
                case 'integer':
                case 'double':
                    $wheres[] = $column . '=' . $value; //['id'=>1]
                    break;
                case 'boolean':
                    $wheres[] = $column . '=' . ($value ? '1' : '0');
                    break;
                case 'string':
                    if(preg_match('/~/',$column)||preg_match('/like/',$column)){//like查询
                        $column = str_replace('~',' LIKE ',$column);
                        $wheres[] = $column . " '%{$value}%'";
                    }else{
                        $wheres[] = $column . '=' . $this->fn_quote($key, $value);
                    }
                    break;
            }
        }
        return implode(' ' . $conjunctor . ' ', $wheres);
    }
    public function array_quote($array)
    {
        $temp = array();
        foreach ($array as $value) {
            $temp[] = is_int($value) ? $value : $this->escape($value);
        }
        return implode($temp, ',');
    }
    // --------------------------------------------------------------------
    /**
     * "Smart" Escape String
     *
     * Escapes data based on type
     * Sets boolean and null types
     *
     * @access    public
     * @param    string
     * @return    mixed
     */
    public function escape($str)
    {
        if (is_string($str)) {
            $str = "'" . $this->escape_str($str) . "'";
        } elseif (is_bool($str)) {
            $str = ($str === FALSE) ? 0 : 1;
        } elseif (is_null($str)) {
            $str = 'NULL';
        }
        return $str;
    }

    /**
     * Escape String
     *
     * @access    public
     * @param    string
     * @param    bool    whether or not the string will be used in a LIKE condition
     * @return    string
     */
    public function escape_str($str, $like = FALSE)
    {
        if (is_array($str)) {
            foreach ($str as $key => $val) {
                $str[$key] = $this->escape_str($val, $like);
            }
            return $str;
        }
        $str = addslashes($str);
        /*
        if(function_exists('mysql_escape_string'))
        {
            $str = mysql_escape_string($str);
        }
        else
        {
            $str = addslashes($str);
        }*/
        // escape LIKE condition wildcards
        if ($like === TRUE) {
            $str = str_replace(array('%', '_'), array('\\%', '\\_'), $str);
        }
        return $str;
    }

}