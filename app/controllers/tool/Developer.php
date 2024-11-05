<?php
/**
 *  fiename: fish/Developer.php$🐘
 *  date:  2024/11/4   13:25$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\tool;
use app\base\BaseController;
use app\helpers\developer\InfoSchema;
use app\helpers\Input;
use app\helpers\developer\FormBuilder;
use app\helpers\developer\SearchController;
use app\helpers\developer\FormSearchList;
use app\helpers\developer\CurdHelper;
use app\models\curd\AdminMenu;

class Developer extends BaseController{

    public function index(){
        /*模块列表*/
//        $modules =  scandir(Yii::$app->basePath."/modules/");
//        $modules = array_filter($modules,function($i){
//            if($i=='.'||$i=='..'){
//                return false;
//            }else{
//                return true;
//            }
//        }
//        );
        $fields = array();
        $select = array();
        //print_r(Yii::$app);
//        if(Yii::$app->request->get('search')){
//            $table = Yii::$app->request->get('table','ga_platform');
//
//        }
        $database = Input::get_post('database','fish_admin');
        $table = Input::get_post('table','','trim');
        $info_schema= new InfoSchema($database);
        $config_table_id = $info_schema->get_table();
        $databases = $info_schema->get_databases();

        list($fields,$select) = $info_schema->get_all_fields($table);

//        return $this->render('index',
//            [
//                'config_modules_id'=>$modules,
//                'config_table_id'=>$config_table_id,
//
//                'config_form_validator_type'=>FormValidator::get_config_form_validator_type(),
//                'config_search_builder_type'=>SearchController::get_config_search_builder_type(),
//                'config_search_list_type'=>FormSearchList::get_config_search_list_type(),
//                'fields'=>$fields,
//                'config_menu'  => (new GaadminMenu)->get_config_menu(null,1)
//            ]
//        );
//        var_dump($config_table_id);
        $config_form_builder_type = FormBuilder::get_config_form_builder_type();
        $config_search_builder_type = SearchController::get_config_search_builder_type();
        $config_search_list_type = FormSearchList::get_config_search_list_type();
        $config_menu = (new AdminMenu())->get_config_menu(null,1);
        $this->view->assign('databases',$databases);
        $this->view->assign('config_table_id',$config_table_id);
        $this->view->assign('fields',$fields);
        $this->view->assign('select',$select);
        $this->view->assign('config_form_builder_type',$config_form_builder_type);
        $this->view->assign('config_search_builder_type',$config_search_builder_type);
        $this->view->assign('config_search_list_type',$config_search_list_type);
        $this->view->assign('config_menu',$config_menu);
        $data['admin_url'] = '/tool/developer/index?iframe=1';
        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('tool/developer/index');
        }else{
            $this->view->display('admin/root/admin_iframe');
        }

    }

    public function preview(){

        $create_file = Input::get_post('create_file','0','intval');
        $database = Input::get_post('database','','trim');
        $table = Input::get_post('table','','trim');
        $get_fields = Input::get_post('fields');
        $get_form_builder_types = Input::get_post("form_builder_types");
        $config_fied_builder_types = array();
        foreach($get_fields as $k=>$field){
            $config_fied_builder_types[$field] = $get_form_builder_types[$k];
        }
        $html = FormBuilder::get_form_html($database,$table,$config_fied_builder_types,$get_form_builder_types);
        highlight_string($html);exit();


    }

    public function create_js(){
        $create_file = Input::get_post('create_file','0','intval');
        $database  = Input::get_post('database','','trim');
        $table =  Input::get_post('table','','trim');
        $fields = Input::get_post('fields','','trim');
        $get_form_builder_types  = Input::get_post("form_builder_types");
        $js = CurdHelper::get_js($database,$table,$fields,$get_form_builder_types);
        highlight_string($js);exit();
    }

    public function create_list(){

        $database =  Input::get_post('database','','trim');
        $table = Input::get_post('table','','trim');
        $fields = Input::get_post('fields');
        $search_list_types = Input::get_post("search_list_types");
        $config_search_list_types = array();
        foreach($fields as $k=>$field){
            $config_search_list_types[$field] = $search_list_types[$k];
        }
        $template_content = CurdHelper::get_search_list($database,$table,$fields,$config_search_list_types);
        highlight_string($template_content);
        exit();
    }

    public function create_controller(){
        $database = Input::get_post('database','','trim');
        $table =Input::get_post('table','','trim');
        $fields = Input::get_post('fields');
        $search_builder_types = Input::get_post('search_builder_types');
        $form_builder_types = Input::get_post('form_builder_types');
        $is_api = Input::get_post('is_api',0,'intval');
        $content = CurdHelper::get_controller($database,$table,$fields,$search_builder_types,$form_builder_types,$is_api);
        highlight_string($content);exit();

    }

    public function create_model(){
        $database = Input::get_post('database','','trim');
        $table =  Input::get_post('table','','trim');
        $fields = Input::get_post('fields');
        $form_validator_types =  Input::get_post('form_validator_types');
        $content = CurdHelper::get_model($database,$table,$fields,$form_validator_types);
        highlight_string($content);
        exit();
    }

    public function create_menu(){
        $database = Input::get_post('database');
        $table = Input::get_post('table');
        $parentid =Input::get_post('parentid');
        $table_name = str_replace('_','/',$table);
        $actions = array(
            'index',
            'create',
            'update',
            'delete',
        );
        $config_action_name = array(
            'index'=>'列表',
            'create'=>'添加',
            'update'=>'修改',
            'delete'=>'删除',
        );
        foreach ($actions as $k=>$action){
            $sql = $sql.<<<SQL
 INSERT INTO  admin_menu (model,action,listorder,name,parentid,level) VALUES ('{$table_name}','{$action}','{$k}','{$config_action_name[$action]}',{$parentid},2);\n

SQL;
        }
        highlight_string($sql);
    }



}