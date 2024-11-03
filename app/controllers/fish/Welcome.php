<?php
/**
 *  fiename: fish/welcome.php$
 *  date: 2024/10/17 23:05:55$
 *  author: hepm<ok_fish@qq.com>$
 */
namespace controllers\fish;
use base\App;
use base\BaseController;
use base\Model;
use helpers\Cache\CacheFactory;
use helpers\Debuger;
use helpers\ModelGenerator;
use helpers\Msg;
use helpers\Session;
use models\Users;



class  Welcome extends BaseController {

    /**
     *
     * http://127.0.0.1:2222/web/index.php/fish/welcome/index
     * http://127.0.0.1:2222/web/index.php?g=fish&m=welcome&a=index
     */
    public function index(){
        $data = [
            'm'=>$this->app->controller,
            'a'=>$this->app->action,
        ];

//        $users = new Users();
//        $one = $users->find(['id'=>1]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
//        $two = $users->find(['id'=>2]);
        $this->view->assign('data',$data);
        $this->view->display('welcome/index');
    }

    public function cache(){
        $cache = CacheFactory::get_instance();
        $cache->set('a',100);
        var_dump($cache->get('a'));
    }

    public function session(){
        Session::init();
        $_SESSION['a'] = '1000';
        var_dump($_SESSION);
    }

    public function msg(){
        $mg = new ModelGenerator();
        $mg->generator_model('fish_cms');
   //     Msg::dump($db->fetch_all($sql_fileds));
        //Msg::dump($_SERVER);
       //Kint::dump($_SERVER);
    }

    public function debug(){
        $message = <<<EOT
        <script> 
    console.error('2024-10-20 00:57:30  >SELECT * FROM ga_admin_user   WHERE id=2'); 
</script>
EOT;
        echo $message;

//        Debug::print_stack_trace();


    }
}