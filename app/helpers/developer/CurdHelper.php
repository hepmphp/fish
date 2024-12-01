<?php
/**
 *  fiename: fish/CurdHelper.php$🐘
 *  date:  2024/11/4   17:18$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\helpers\developer;
class CurdHelper {
    /**
     * 获取js
     * @param $module_id  模块id
     * @param $table      表名
     * @param $fields     字段
     * @param $get_form_builder_types 生成类型
     * @return mixed|string
     */
    public static function get_js($database,$table,$fields,$get_form_builder_types){

        $table_field = (new InfoSchema($database))->get_table_field($table);
        $database = str_replace('fish_','',$database);
//        APP_PATH.'views/{$database}/$table/
        $template_js =   APP_PATH.'views/tool/developer/template/js/index.js';
        $template_content = file_get_contents($template_js);
        // echo $template_content;
        $from_data = '';
        $from_data_str = array();
        foreach($table_field as $v){
            if(in_array($v['COLUMN_NAME'],$fields)){
                $from_data_str[] = "\t\t\t\t\t{$v['COLUMN_NAME']}:body.find('#{$v['COLUMN_NAME']}').val()";
            }
        }
        $table_arr = explode('_',$table);
        $_talbe = end($table_arr);
        $from_data .= PHP_EOL.implode(','.PHP_EOL,$from_data_str);
        $from_data .= PHP_EOL;
        $template_content = str_replace(array('[path]','[table]','[form_data]'),array($database,$_talbe,$from_data),$template_content);
        return $template_content;
    }

    /**
     * 获取视图路径
     * @param $module_id 模块id
     * @param $table     表名
     * @return string
     */
    public static function get_view_path($database,$table){
        $database = str_replace('fish_','',$database);
        $table_arr = explode('_',$table);
        $_talbe = end($table_arr);
        $view_path = APP_PATH.'/views/{$database}/{$_talbe}/';
        if(!is_dir($view_path)){
            mkdir($view_path,0755,true);
        }
        return $view_path;
    }

    /**
     * 获取控制器内容
     * @param $namespace   命名空间
     * @param $model       模型的路径空间
     * @param $controller_name 控制器名称
     * @param $table           表名
     * @param $fields          字段
     * @param $search_builder_types 搜索
     * @param $form_builder_types   列表自动获取下拉选项
     * @return mixed
     */
    public static function get_controller($database,$table,$fields,$search_builder_types,$form_builder_types,$is_api=0){
        if($is_api==1){
            $content =  file_get_contents(APP_PATH.'views/tool/developer/template/html/controller_api.php');
        }else{
            $content =  file_get_contents(APP_PATH.'views/tool/developer/template/html/controller.php');
        }

        //搜索条件替换
        $where_tpl = <<<EOT
        \$[field] = Input::get_post('[field]','','trim');
        if(\$[field]){
          if(!Validate::required('[field]')){
               throw  new  LogicException(-1,'链接名称');
           }
           \$where['[field]'] = \$[field];
        }
            \n
EOT;
        //搜索条件替换
        $where_num_tpl = <<<EOT
        \$[field] = Input::get_post('[field]','','trim');
        if(is_numeric(\$[field])){
           \$where['[field]'] = \$[field];
        }
            \n
EOT;
        $where_time_range = <<<EOT
        \$start_time = Input::get_post('start_time','','trim');
        \$end_time = Input::get_post('end_time','','trim');
       
        if(!empty(\$start_time)){
            if(!Validate::required('start_time')){
                   throw  new  LogicException(-1,'请输入开始时间');
            }
            \$where['start_time > '] =strtotime(\$start_time);
        }
        if(!empty(\$end_time)){
            if(!Validate::required('end_time')){
                   throw  new  LogicException(-1,'请输入结束时间');
            }
            \$where['end_time < '] = strtotime(\$end_time);
        }
           \n
EOT;
        $where_str = "\n";
        //替换搜索项
        $select_tree_str="";
        $select_tree_id_str="";
        $form_builder_type = '';
        foreach($fields as $k=>$field){
            $searc_builder_type = $search_builder_types[$k];
            if($searc_builder_type=='search_text'){
                $where_str .= str_replace('[field]',$field,$where_tpl);
            }else if($searc_builder_type=='search_num'){
                $where_str .= str_replace('[field]',$field,$where_num_tpl);
            }else if($searc_builder_type=='search_time'){
                $where_str .= str_replace('[field]',$field,$where_time_range);
            }else{

            }
        }
        //自动添加配置
        //get_config_[field]
        list($db_fields,$select) = (new InfoSchema($database))->get_all_fields($table);
        $config_str = array();
        $tbname = explode('_',$table);
        unset($tbname[0]);
        $tbname = array_map(function ($val){
            return ucwords($val);
        },$tbname);
        $tbname = implode('',$tbname);
        /**
         * $[config_status] = get_[config_status]();
             $this->view->assign(' [config_status]', $[config_status]);
         */
        foreach($select as $k=>$s){
            $config_str[] ="\t\t \$config_{$k} = ". sprintf("\$this->%s->get_config_%s()",$table,$k).";\n";
            $config_str[] ="\t\t \$this->view->assign('config_{$k}',$"."config_{$k});\n";
        }
        $config_str = implode("",$config_str);

        $database = str_replace('fish_','',$database);
        $table = str_replace(array('cms_','admin_','bbs_'),['','',''],$table);
        $content = str_replace(
            array('[database]','[table]','[model]','[search_where]','[config_status]'),
            array($database,$table,$tbname,$where_str,$config_str),
            $content);
        return $content;
    }

    /**
     * 获取模型
     * @param $namespace   命名空间
     * @param $model_name  模型名称
     * @param $table       表名
     * @param $fields      字段
     * @param $form_validator_types 验证类型
     * @return mixed
     */
    public static function get_model($database,$table,$fields,$form_validator_types){

        $info_schema = new InfoSchema($database);
        $data = $info_schema->get_all_fields($table);
        $model_template = file_get_contents(APP_PATH.'views/tool/developer/template/html/Users.php');
        $tbname = explode('_',$table);
        unset($tbname[0]);
        $tbname = array_map(function ($val){
            return ucwords($val);
        },$tbname);
        $tbname = implode('',$tbname);
        $template = str_replace(array('[database]','[Users]','[t]','[p]'),array( str_replace('fish_','',$database),str_replace('/','',$tbname),$table,''),$model_template);
        $config_tpl = <<<EOT
    public static function get_config_[field](){
            return [
                tpl
            ];
    }
EOT;
        $config_data= array();
        $config_str = '';
        foreach($data as $k=>$s){
            $formart_arr = array();
            foreach($s as $k2=>$s2){
                if(!is_array($s2)){continue;}
                foreach ($s2 as $k3=>$s3){
                    $formart_arr[$k2][] = "{$s3['id']}=>['id'=>{$s3['id']},'name'=>'{$s3['name']}'],\n";
                }
                $config_data[] = str_replace(array('[field]','tpl'),array($k2,implode("\t\t\t\t",$formart_arr[$k2])),$config_tpl)."\n";
            }
        }
        $config_str = implode("\n\t",$config_data);
        $template = str_replace('}#end',$config_str."\n\n}#end",$template);
        $template = $template.PHP_EOL.'##生成时间:'.date('Y-m-d H:i:s').' 文件路径：'.$tbname.'.php🐘';
        return $template;
    }

    /**
     * 获取列表视图
     * @param $table  表
     * @param $fields 字段
     * @param $config_search_list_types 搜索类型
     * @return mixed
     */
    public static function get_search_list($database,$table,$fields,$config_search_list_types){
        list($db_fields,$select) = (new InfoSchema($database))->get_all_fields($table);
        $table_field = (new InfoSchema($database))->get_table_field($table);
        //APP_PATH.'views/admin/developer/template/html/
        $template = APP_PATH.'views/tool/developer/template/html/list.php';
        $template_content = file_get_contents($template);

        //搜索框
        $form_search = '';
        foreach($db_fields as $field=>$name){
            $fb_func = $config_search_list_types[$field];
            if(strpos($fb_func,'search_none')!==false||empty($fb_func)){
                continue;
            }
            if(isset($select[$field])){
                $form_search .= FormSearchList::$fb_func($field,$name,$select[$field]);
            }else{
                $form_search .= FormSearchList::$fb_func($field,$name);
            }
        }

        $table_header = "";
        $td_template = "";
        $td_data = "\n";
        $search_param = "\n";
        $i = 1;
        $total_filelds = count($db_fields);

        foreach($db_fields as $k=>$v){
            if(in_array($k,$fields)){
                $table_header = $table_header."\t\t\t\t<th>{$v}</th>\n";
                $td_template = $td_template."\t\t'<td>[{$k}]</td>'+\n";
                if($k=='id'){
                    $td_data = $td_data."\t\t\t\t\treplace(/\[{$k}\]/g, d.{$k}).\n";
                }else{
                    if($total_filelds==$i){
                        $td_data = $td_data."\t\t\t\t\treplace('[{$k}]', d.{$k}); \n";
                    }else{
                        $td_data = $td_data."\t\t\t\t\treplace('[{$k}]', d.{$k}).\n";
                    }

                }
                $search_param = $search_param."\t\t\t{$k}:\$('#{$k}').val(),\n";

                $td_data = "\t\t\t".$td_data;
                $i++;
            }
        }
        $search_param_tpl = <<<TPL
        var search_param= {
            page: 1,
            per_page :100,[search_param]
        };
TPL;

        $search_param = str_replace('[search_param]',$search_param,$search_param_tpl);
        //列表
        $template_content = str_replace(
            array('[search_field]','[table_header]','[td_template]','[search_param]','[td_data]','[table]'),
            array($form_search,$table_header,$td_template,$search_param,$td_data,$table),
            $template_content);
        return $template_content;

    }
}