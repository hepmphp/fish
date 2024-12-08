<?php

namespace app\controllers\api\publish;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\publish\PublishTask as M_PublishTask;
use app\models\curd\publish\Project;

class Task extends BaseController{

    public $pub_publish_task = '';
    public $project  = '';
    public function __construct()
    {
        $this->pub_publish_task = new M_PublishTask();
        $this->project = new Project();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();
        
        $admin_id = Input::get_post('admin_id','','trim');
        if($admin_id){
          if(!Validate::required('admin_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['admin_id'] = $admin_id;
        }
            
        $deploy_admin_id = Input::get_post('deploy_admin_id','','trim');
        if($deploy_admin_id){
          if(!Validate::required('deploy_admin_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['deploy_admin_id'] = $deploy_admin_id;
        }
            
        $project_id = Input::get_post('project_id','','trim');
        if($project_id){
          if(!Validate::required('project_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['project_id'] = $project_id;
        }
            
        $project_name = Input::get_post('project_name','','trim');
        if($project_name){
          if(!Validate::required('project_name')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['project_name'] = $project_name;
        }

        $project_name = Input::get_post('project_name','','trim');
        if($project_name){
            if(!Validate::required('project_name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['project_name'] = $project_name;
        }

        $file_list = Input::get_post('file_list','','trim');
        if($file_list){
            if(!Validate::required('file_list')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['file_list'] = $file_list;
        }

        $comment = Input::get_post('comment','','trim');
        if($comment){
            if(!Validate::required('comment')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['comment'] = $comment;
        }
            
        $status = Input::get_post('status','','trim');
        if($status){
          if(!Validate::required('status')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['status'] = $status;
        }
            
        $start_time = Input::get_post('start_time','','trim');
        $end_time = Input::get_post('end_time','','trim');
       
        if(!empty($start_time)){
            if(!Validate::required('start_time')){
                   throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['start_time > '] =strtotime($start_time);
        }
        if(!empty($end_time)){
            if(!Validate::required('end_time')){
                   throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['end_time < '] = strtotime($end_time);
        }
           

        $where = array_filter($where);
        return $where;
    }

    public function create(){
        $form = $this->get_search_where();
        $this->pub_publish_task->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->pub_publish_task->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->pub_publish_task->delete($form);
    }

    public function publish(){
        $publish_id = Input::get_post('id','','intval');
        $task = $this->pub_publish_task->info(['id'=>$publish_id]);
        $project = $this->project->info(['id'=>$task['project_id']]);
        if($task['status']!=1){
            Input::ajax_return(-1,'只有待同步的状态才可以发布','',true);
            exit();
        }
        //先执行备份操作
        $back_status = $this->add_www_backup($task['id'],$project['rsync_local_www'],$project['rsync_back_www'],$project['keep_version_num']);
        if($back_status){
            if($task['file_list']=='*'){
                list($rsync_log,$rsync_log_file,$rsync_status) = $this->rsync_all($project['rsync_local_www'],$project['rsync_user'],$project['rsync_remote_hosts'],$project['rsync_remote_www']);
            }else{
                list($rsync_log,$rsync_log_file,$rsync_status) = $this->rsync($publish_id,$project['rsync_local_www'],$project['rsync_user'],$project['rsync_remote_hosts'],$project['rsync_remote_www']);
            }
            if($rsync_status==0){
                $publish_data['id'] = $publish_id;
                $publish_data['rsync_log'] =$rsync_log;
                $publish_data['rsync_log_file'] = $rsync_log_file;
                $publish_data['status'] = 0;
                $publish_data['deploy_admin_id'] = $_SESSION['admin_user_id'];
                $this->pub_publish_task->save_result($publish_data);
                Input::ajax_return(0,'发布成功');
            }else{
                $publish_data['id'] = $publish_id;
                $publish_data['rsync_log'] =$rsync_log;
                $publish_data['rsync_log_file'] = $rsync_log_file;
                $publish_data['status'] = 2;
                $publish_data['deploy_admin_id'] = $_SESSION['admin_user_id'];
                $this->pub_publish_task->save_result($publish_data);
                Input::ajax_return(-1,'发布失败');
            }
        }else{
            Input::ajax_return(-1,'备份失败');
        }
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->pub_publish_task->get_list_info($where,$page,$per_page,'*');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        if($res){
            Input::ajax_return(0,'获取数据成功',$data);
        }else{
            throw new LogicException(100,'没有数据');
        }
    }

    /**
     * 添加备份 自动删除多余的备份
     */
    function add_www_backup($publish_id,$local_www,$www_backup,$version_num){
        /*
          1.检查备份目录是否存在 不存在创建并修改权限
          2.检查备份数 超过自动删除  ls|sort -nr|awk 'NF{a=$0}END{print a}'|xargs rm -rf
         */
        $www_backup = $www_backup."/".$publish_id."/";
        if(!is_dir($www_backup)){
            mkdir("/data/logs/rsync/",0755,true);
            mkdir($www_backup,0777,true);
            chown($www_backup,'www-data');
        }
        chdir($www_backup);
        $www_backup_slash = str_replace('/',"\\/",$www_backup);
        $cmd = <<<CMD
        /bin/ls  %s|sort -nr|sed -n '%s,\$p'|sed 's/^/%s/'|xargs sudo rm -rf
CMD;

        $cmd = sprintf($cmd,$www_backup,$version_num,$www_backup_slash);
        exec($cmd,$log,$return);
        error_log(date("Y-m-d H:i:s")."\t".trim($cmd,"\n").var_export($log,true)."return:".$return.PHP_EOL,3,'/data/logs/rsync/add_www_backup.log');

        //获取备份版本id
        $cmd_wc_l = <<<CMD
        /bin/ls  /www/git/fish.backup/4|sort -nr|head -n 1
CMD;
        $cmd_wc_l = sprintf($cmd_wc_l,$www_backup);

        exec($cmd_wc_l,$cmd_wc_l_res,$return);
        if(empty($cmd_wc_l_res)){
            $version_num = 1;
        }else{
            $version_num =$cmd_wc_l_res[0]+1;
        }

        //备份
        $cmd_cp = "/bin/cp -r %s %s";
        $cmd_cp = sprintf($cmd_cp,$local_www,$www_backup."/".$version_num);
        exec($cmd_cp,$log_cp,$cp_return);
        error_log(date("Y-m-d H:i:s")."\t".$cmd_cp." log:"."return:".$cp_return.PHP_EOL,3,'/data/logs/rsync/add_www_backup.log');
        if(is_numeric($cp_return) && $cp_return==0){
            return true;
        }else{
            return false;
        }
    }


    /**
     * 获取备份目录
     */
    function get_backup_dirs(){
        $publish_id = Input::get_post('publish_id','0','intval');//发布id
        $task = $this->pub_publish_task->info(['id'=>$publish_id]);
        $project = $this->project->info(['id'=>$task['project_id']]);
        $backup_dir = $project['rsync_back_www'].'/'.$publish_id;
        //scandir
        $backup_dir_list = scandir($backup_dir);
        $dir_list = array();
        rsort($backup_dir_list);
        foreach($backup_dir_list as $k=>$v){
            if($v=='.'||$v=='..'){
                continue;
            }
            $dir_list[] = array(
                'id'=>$v,
                'name'=>$v,
            );

        }
        Input::ajax_return(0,'',$dir_list);
    }

    /**
     * 从备份目录直接还原
     */
    function rollback(){
        $publish_id = Input::get_post('publish_id',0,'intval,trim');//发布id
        $backup_dir = Input::get_post('backup_dir','','trim');//备份的目录
        $rollback_comment = Input::get_post('rollback_comment','','trim');//还原备注
        $task = $this->pub_publish_task->info(['id'=>$publish_id]);
        $project = $this->project->info(['id'=>$task['project_id']]);

        $rollback_dir = $project['rsync_back_www']."/{$publish_id}/{$backup_dir}";
        //检查备份是否存在
        if(!file_exists($rollback_dir)){
            Input::ajax_return(0,"备份{$rollback_dir}不存在");
        }
        $publish_data = [
            'id'=>$publish_id,
            'rollback_comment'=>$rollback_comment,
            'status'=>3
        ];
        $this->pub_publish_task->save_result($publish_data);
        list($rsync_command,$rsync_log,$rsync_status) = $this->rsync_all($rollback_dir,$project['rsync_user'],$project['rsync_remote_hosts'],$project['rsync_remote_www'],$rollback_dir);
        if($rsync_status==0){
            $publish_data = [
                'id'=>$publish_id,
                'rsync_log'=>$rsync_command,
                'status'=>4
            ];
            $this->pub_publish_task->save_result($publish_data);
            Input::ajax_return(0,'还原成功');
        }else{
            $publish_data = [
                'id'=>$publish_id,
                'rsync_log'=>$rsync_command,
                'status'=>5
            ];
            $this->pub_publish_task->save_result($publish_data);
            Input::ajax_return(-1,'还原失败');
        }
    }

    /**
     * 获取git标签
     */
    function get_git_tags(){
        $publish_id = Input::get_post('publish_id',0,'intval');//发布id
        $task = $this->pub_publish_task->info(['id'=>$publish_id]);
        $project = $this->project->info(['id'=>$task['project_id']]);
        $backup_git_dir = $project['rsync_local_www'].".backup.git/";
        if(!is_dir($backup_git_dir)){
            mkdir($backup_git_dir,0755,true);
            chown($backup_git_dir,'www');
        }
        /*
          1.检测git目录是否存在
          2.不存在git目录执行 git clone
          3.执行git tag -l 获取git标签
        */
        $backup_git_dir_repo = $backup_git_dir.'/'.basename($project['repo_url'],'.git');
        if(!is_dir($backup_git_dir_repo)){
            chdir($backup_git_dir);
            $git_cmd[] = "/usr/bin/git clone {$project['repo_url']}";
        }else{
            chdir($backup_git_dir_repo);
        }
        $git_cmd[] = "/usr/bin/git fetch --all";
        $git_cmd[] = "/usr/bin/git reset --hard origin/master";
        $git_cmd[] = "/usr/bin/git fetch --tags";
        foreach($git_cmd as $cmd){
            exec($cmd,$cmd_log,$cmd_return);
        }
        $git_tag = "/usr/bin/git tag -l";
        exec($git_tag,$tag_log,$tag_return);
        if($tag_return==0){
            natcasesort($tag_log);
            $tags = array();
            foreach($tag_log as $log){
                $tags[] = array(
                    'id'=>$log,
                    'name'=>$log,
                );
            }
            Input::ajax_return(0,'',$tags);
        }else{
            Input::ajax_return(1,'获取标签失败'.$git_tag."\n backup_git_dir:".$backup_git_dir."backup_git_dir_repo:".$backup_git_dir_repo);
        }

    }

    /**
     * 直接从git上面下载 rsync出去
     */
    function rollback_from_git(){
        $publish_id =Input::get_post('publish_id',0,'intval');//发布id
        $git_tag = Input::get_post('git_tag','','trim');//git标签
        $rollback_comment = Input::get_post('rollback_comment','','trim');//还原备注
        $publish_data = [
            'id'=>$publish_id,
            'rollback_comment'=>"git 标签：".$git_tag."备注：".$rollback_comment,
            'status'=>3
        ];
        $this->pub_publish_task->save_result($publish_data);

        $task = $this->pub_publish_task->info(['id'=>$publish_id]);
        $project = $this->project->info(['id'=>$task['project_id']]);
        $backup_git_dir = $project['rsync_local_www'].'.backup.git/'.basename($project['repo_url'],'.git');
        //切换到对应的标签分支
        chdir($backup_git_dir);
        error_log(date("Y-m-d H:i:s")."dir:{$backup_git_dir}".PHP_EOL,3,'/data/logs/rsync/rollback_from_git.log');
        $git_checkout = "/usr/bin/git checkout %s";
        $git_checkout = sprintf($git_checkout,$git_tag);
        error_log(date("Y-m-d H:i:s")."git checkout:{$git_checkout}".PHP_EOL,3,'/data/logs/rsync/rollback_from_git.log');
        exec($git_checkout,$check_log,$check_return);
        if(is_numeric($check_return) && $check_return==0){
            list($rsync_command,$rsync_log,$rsync_status) = $this->rsync_all($project['rsync_local_www'],$project['rsync_user'],$project['rsync_remote_hosts'],$project['rsync_remote_www'],$backup_git_dir);
            if($rsync_status==0){
                $publish_data = ['id'=>$publish_id,'rsync_log'=>$rsync_log,'status'=>4];
                $this->pub_publish_task->save_result($publish_data);
                Input::ajax_return(0,'还原成功');
            }else{
                $publish_data = ['id'=>$publish_id,'rsync_log'=>$rsync_log,'status'=>5];
                $this->pub_publish_task->save_result($publish_data);
                Input::ajax_return(-1,'还原失败');
            }
        }else{
            Input::ajax_return(-1,'git 切换到标签'.$git_tag."失败");
        }
    }

    /**
     * 发布所有文件
     * @param $local_www    本地的路
     * @param $host  远程ip
     * @param $remote_www  远程的路径 todo::可以设置ssh
     */
    function rsync_all($local_www,$rsync_user,$host,$remote_www,$rollback_dir=false){
        $remote_www = pathinfo($remote_www)['basename'];
        $local_www_final = pathinfo($local_www)['basename'];
        $rsync_command = "sudo rsync -avH --port=873 --progress --delete --exclude-from=%s --log-file=%s %s %s@%s::%s --password-file=/data/logs/rsync/passwd_rsync.txt";
        $rsync_log_file = '/data/logs/rsync/rsync_log_file.txt';
        if($rollback_dir){
            $rsync_command = sprintf($rsync_command, '/data/logs/rsync/'.$local_www_final.'/rsync_exclude_from.txt', $rsync_log_file, $rollback_dir,$rsync_user,$host,$remote_www);
        }else{
            $rsync_command = sprintf($rsync_command, '/data/logs/rsync/'.$local_www_final.'/rsync_exclude_from.txt', $rsync_log_file, $local_www,$rsync_user,$host,$remote_www);
        }
        error_log(date("Y-m-d H:i:s")."\t".$rsync_command.PHP_EOL,3,'/data/logs/rsync/rsync_all.log');
        exec($rsync_command,$rsync_log,$rsync_return);
        return array($rsync_command,$rsync_log_file,$rsync_return);
        //todo update dp_site_deploy  rsync_log//更新站点的rsync日志
    }

    function rsync($publish_id,$local_www,$rsync_user,$host,$remote_www){
        //--delete-missing-args
        $remote_www = pathinfo($remote_www)['basename'];
        $local_www_final = pathinfo($local_www)['basename'];
        $exclude_from =  '/data/logs/rsync/'.$local_www_final.'/rsync_exclude_from.txt';
        $rsync_log_file = '/data/logs/rsync/rsync_log_file.txt';
        $from_file = "/data/logs/publish/rsync_files_from.{$publish_id}.txt";

        $rsync_command = "sudo rsync -avH --port=873 --progress  --exclude-from=%s --log-file=%s --files-from=%s %s %s@%s::%s --password-file=/data/logs/rsync/passwd_rsync.txt";
        $rsync_command = sprintf($rsync_command,$exclude_from,$rsync_log_file,$from_file, $local_www,$rsync_user,$host,$remote_www);
        error_log(date("Y-m-d H:i:s")."\t".$rsync_command.PHP_EOL,3,'/data/logs/rsync/rsync.log');
        exec($rsync_command,$rsync_log,$rsync_return);
        //todo update dp_site_deploy  rsync_log//更新站点的rsync日志
        return array($rsync_command,$rsync_log_file,$rsync_return);
    }
}