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
        $data['admin_url'] = '/admin/developer/index?iframe=1';
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
        if($create_file==1){
//            $view_path = CurdHelper::get_view_path($database,$table);
//            //视图
//            //modules/cms/view/cms-cate/create
//            $view_file = $view_path.'/create.php';
//            //  echo $view_file;
//            if(!file_exists($view_file)){//不允许覆盖
//                $res = file_put_contents($view_file,$html);
//                if($res){
//                    $response = array(
//                        'status'=>0,
//                        'msg'=>Yii::t('app','视图创建成功')
//                    );
//                }else{
//                    $response = array(
//                        'status'=>-2,
//                        'msg'=>Yii::t('app','视图创建失败')
//                    );
//                }
//            }else{
//                $response = array(
//                    'status'=>-1,
//                    'msg'=>Yii::t('app','视图已存在,请手动覆盖')
//                );
//            }
//            return $this->asJson($response);
        }else{
            highlight_string($html);exit();

        }
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

    }



}