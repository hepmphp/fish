<?php
/**
 *  fiename: fish/mysql.php$🐘
 *  date:  2024/11/10   20:30$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
include 'PdoHelper.php';
include 'SqlQueryBuilder.php';


class Model{
    public $db='';
    public $table = '';
    public $db_prefix = '';
    public $sql_query_builder  = '';


    public function __construct($config)
    {
        $config= [
            'host' => 'mysql',
            'dbname' => 'fish_im',
            'username' => 'root',
            'password' => '123456',
            'port' => 3306,
            'charset' => 'utf8',
        ];
        $this->db = new PdoHelper($config);
        $this->sql_query_builder = new SqlQueryBuilder();
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
        echo $sql."\n";
        $res = $this->db->fetch($sql);
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
    public function find_all($where, $limit=1, $offset=100, $fields = '*')
    {
        $sql = $this->sql_query_builder
            ->table($this->table)
            ->field($fields)
            ->where($where)
            ->limit($limit, $offset)
            ->fetch_all();
        $res = $this->db->fetch_all($sql);
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
        echo $sql;
        $this->db->exec($sql);
        return  $this->db->last_insert_id();

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
        return $this->db->exec($sql);
    }

    /**
     * 获取列表数据
     * @param array $where
     * @param int $per_page
     * @param int $offset
     */
    public function get_list($where = array(), $limit = 1, $offset = 100, $fields = '*',$order_by='id asc')
    {
        $sql = $this->sql_query_builder->table($this->table)->field($fields)->where($where)->limit($limit, $offset)->order_by($order_by)->fetch_all();
        $res = $this->db->fetch_all($sql);
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
        $res = $this->db->count($sql);
        return $res;
    }




}


/**
id	int unsigned Auto Increment
fid	int unsigned [0]	socket连接id
account	varchar(30)	账号
password	char(32)	发送者
salt	varchar(20)	密钥
nickname	varchar(50) [匿名]	昵称
avatar	varchar(100) [/static/images/pkq.png]	头像
signature	varchar(100) []	签名
status	tinyint unsigned [1]	在线状态 0在线 1下线 2隐身
login_time	int unsigned [0]	上次登录时间
create_time	int unsigned [0]	创建时间
update_time	int unsigned NULL [0]	修改时间
delete_time	int unsigned NULL [0]	删除时间
 */

class ChatMember extends Model{
    public $table='chat_member';
    public function __construct($config)
    {
        parent::__construct($config);
    }
    public function info($where){
        $res = $this->find($where);
        return $res;
    }
    public function save($data){
        $this->update($data,['username'=>$data['username']]);
    }
}

class ChatMsgbox extends Model{
    public $table='chat_msgbox';
    public function __construct($config)
    {
        parent::__construct($config);
    }
    public function info($where){
        $res = $this->find($where);
        return $res;
    }
    public function create($data){
        $res = $this->insert($data);
        return $res;
    }
}
class ChatRecord extends Model{
    public $table='chat_record';
    public function __construct($config)
    {
        parent::__construct($config);
    }
    public function info($where){
        $res = $this->find($where);
        return $res;
    }
    public function create($data){
        $res = $this->insert($data);
        return $res;
    }
}




