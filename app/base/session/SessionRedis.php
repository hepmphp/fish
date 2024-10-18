<?php
/**
 *  fiename: fish/SessionRedis.php$🐘
 *  date: 2024/10/18 15:26:25$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace base\session;
use base\App;
use helpers\Cache\CacheRedis;

/**
 * redis session
 * Class SessionRedis
 */
class SessionRedis {

    public $prefix = 'fish_session';
    /**
     * Session有效时间
     */
    protected $lifeTime      = '';


    /**
     * 数据库句柄
     */
    protected $redis  = array();

    /**
     * 打开Session
     * @access public
     * @param string $savePath
     * @param mixed $sessName
     */
    public function open($savePath='', $sessName='') {
        $config_redis = App::get_instance(APP_PATH)::$config['session']['redis'];
        $config_session = App::get_instance(APP_PATH)::$config['session']['session'];
        $this->lifeTime = $config_session['SESSION_OPTIONS']['expire']?$config_session['SESSION_OPTIONS']['expire']:ini_get('session.gc_maxlifetime');
//        var_dump( $this->lifeTime);exit();
        $this->redis = (new CacheRedis($config_redis))->redis;
        return true;
    }

    /**
     * 关闭Session
     * @access public
     */
    public function close() {
        //   var_dump($this->redis);
        return $this->redis->close();
    }

    /**
     * 读取Session
     * @access public
     * @param string $sessID
     */
    public function read($sessID) {
        $data = $this->redis->get($this->prefix.$sessID);
        $data = unserialize($data);
        return $data;
    }

    /**
     * 写入Session
     * @access public
     * @param string $sessID
     * @param String $sessData
     */
    public function write($sessID,$sessData) {
        $expire = time() + $this->lifeTime;
        //   var_dump($sessID);
        $this->redis->set($this->prefix.$sessID,serialize($sessData),$expire);
        return true;
    }

    /**
     * 删除Session
     * @access public
     * @param string $sessID
     */
    public function destroy($sessID) {
        return $this->redis->rm($this->prefix.$sessID);
    }


    /**
     * Session 垃圾回收
     * @access public
     * @param string $sessMaxLifeTime
     */
    public function gc($sessMaxLifeTime) {
        return true;
    }

    /**
     * 打开Session
     * @access public
     */
    public function execute() {
        session_set_save_handler(array(&$this,"open"),
            array(&$this,"close"),
            array(&$this,"read"),
            array(&$this,"write"),
            array(&$this,"destroy"),
            array(&$this,"gc"));
    }
}