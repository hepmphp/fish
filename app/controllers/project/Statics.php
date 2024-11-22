<?php
namespace app\controllers\project;
use app\base\BaseController;
use app\models\curd\project\Project;
use app\models\curd\project\Task;
use app\models\curd\project\Bug;
/**
 *  fiename: fish/Statics.php$🐘
 *  date:  2024/11/22   13:56$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

class Statics extends BaseController{

    public $pj_project = '';
    public $pj_task  = '';
    public $pj_bug = '';
    public function __construct()
    {
        $this->pj_project = new Project();
        $this->pj_task = new Task();
        $this->pj_bug = new Bug();
        parent::__construct();

    }

    public function index(){

        $projects = $this->pj_project->exec_fetch_all(' count(*) as total','','id desc');
        $tasks = $this->pj_task->exec_fetch_all(' count(*) as total','','id desc');
        $bugs = $this->pj_bug->exec_fetch_all(' count(*) as total','','id desc');

        $projects_group = $this->pj_project->exec_fetch_all(' owner_user_id,owner_user,count(*) as total','','',' owner_user_id,owner_user');
        $tasks_group = $this->pj_task->exec_fetch_all(' owner_user_id,owner_user,count(*) as total','','','owner_user_id,owner_user');
        $bugs_group = $this->pj_bug->exec_fetch_all(' owner_user_id,owner_user,count(*) as total','','',' owner_user_id,owner_user');

        $static_data[] = ['value'=>$projects[0]['total'],'itemStyle'=>['color'=>'red']];
        $static_data[] =  ['value'=>$tasks[0]['total'],'itemStyle'=>['color'=>'blue']];
        $static_data[] =  ['value'=>$bugs[0]['total'],'itemStyle'=>['color'=>'green']];
        $static_data_line[] = $projects[0]['total'];
        $static_data_line[] = $tasks[0]['total'];
        $static_data_line[] = $bugs[0]['total'];

        $static_data_group['projects_group'] = $projects_group;
        $static_data_group['tasks_group'] = $tasks_group;
        $static_data_group['bugs_group'] = $bugs_group;
        $data['admin_url'] = '/project/statics/index?iframe=1';
        $this->view->assign('data', $data);
        $this->view->assign('static_data',$static_data);
        $this->view->assign('static_data_line',$static_data_line);
        $this->view->assign('static_data_group',$static_data_group);
        if (isset($_GET['iframe']) && $_GET['iframe'] == 1) {
            $this->view->display('project/statics/index');
        } else {
            $this->view->display('admin/root/admin_iframe');
        }
    }
}