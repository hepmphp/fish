<?php
/**
 *  fiename: fish/InfoScheme.php$🐘
 *  date: 2024/10/18 17:51:35$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\helpers\developer;
use app\base\App;

class InfoSchema
{
    public $table_schema = 'fish_admin';//数据库名称

    public function __construct($table_schema = 'fish_admin')
    {
        $this->table_schema = $table_schema;
    }

    public function get_databases(){
        $sql = "SELECT SCHEMA_NAME AS name FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME LIKE '%fish%'";
        $db = App::get_db();
        $data = $db->fetch_all($sql);
        $data_reform = [];
        foreach ($data as $k=>$v){
            $data_reform[] = $v['name'];
        }
        return $data_reform;
    }

    /**
     * @param $table
     * @return array
     */
    public function get_table_field($table)
    {
        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name ='{$table}' and TABLE_SCHEMA='{$this->table_schema}' ORDER BY ORDINAL_POSITION";
        $db = App::get_db();
        $data = $db->fetch_all($sql);
        return $data;
    }

    /***
     * 获取表字段
     * @param string $table
     * @return array|\yii\db\false
     */
    public function get_table($table = '')
    {
        $sql = "SELECT table_name as id,table_comment as name from INFORMATION_SCHEMA.`TABLES` where TABLE_SCHEMA='{$this->table_schema}'";
        if (!empty($table)) {
            $sql .= " AND table_name='{$table}'";
        }
        $db = App::get_db();
        $data = $db->fetch_all($sql);
        return $data;
    }

    /**
     * 获取所有字段  字段名=>备注
     */
    public function get_all_fields($table)
    {
        $table_field =$this->get_table_field($table);
        $fields = array();
        $select = array();//下拉框
        foreach ($table_field as $k => $v) {
            if (stripos($v['COLUMN_COMMENT'], '|') !== false) {//统一的格式 状态|0:显示,1:不显示
                $comment = explode('|', $v['COLUMN_COMMENT']);
                if (strpos($v['COLUMN_COMMENT'], ':') !== false) {
                    $fields[$v['COLUMN_NAME']] = $comment[0];
                    $select_item = explode(',', $comment[1]);
                    foreach ($select_item as $s => $it) {
                        $item = explode(':', $it);
                        $select[$v['COLUMN_NAME']][] = array('id' => $item[0], 'name' => $item[1]);
                    }
                } else {
                    $fields[$v['COLUMN_NAME']] = $v['COLUMN_COMMENT'];
                }

            } else {
                $fields[$v['COLUMN_NAME']] = $v['COLUMN_COMMENT'];
            }
        }
        return array($fields, $select);
    }
}
