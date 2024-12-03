<?php
/**
 *  fiename: fish/Index.php$🐘
 *  date:  2024/11/2   23:42$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace doc\controllers\web;

use app\helpers\Input;
use app\helpers\Validate;
use doc\base;
use doc\base\DocController;
use doc\base\exception\LogicException;
use doc\helpers\ReadDocument;
use doc\models\doc\Folder;
use doc\models\doc\File as M_File;
use doc\helpers\WordPHP;


class File extends DocController{

    public $forum = array();
    public $doc_folder = array();
    public $doc_file = array();
    public function __construct()
    {
        $this->doc_folder = new Folder();
        $this->doc_file = new M_File();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();

        $id = Input::get_post('id','','trim');
        if($id){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'id不能为空');
            }
            $where['id'] = $id;
        }

        $folder_id = Input::get_post('folder_id','','trim');
        if($folder_id){
            if(!Validate::required('folder_id')){
                throw  new  LogicException(-1,'目录id');
            }
            $where['folder_id'] = $folder_id;
        }

        $name = Input::get_post('name','','trim');
        if($name){
            if(!Validate::required('name')){
                throw  new  LogicException(-1,'名称不能为空');
            }
            $where['name'] = $name;
        }

        $folder_name = Input::get_post('folder_name','','trim,strip_tags');
        if($folder_name){
            if(!Validate::required('folder_name')){
                throw  new  LogicException(-1,'名称不能为空');
            }
            $folder_name = str_replace('└ ','',$folder_name);
            $folder_name = str_replace(' ','',$folder_name);
            $where['folder_name'] = $folder_name;
        }

        $file = Input::get_post('file','','trim');
        if($file){
            if(!Validate::required('file')){
                throw  new  LogicException(-1,'文件不能为空');
            }
            $where['file'] = $file;
        }
        $file_lists = Input::get_post('file_lists');
        if($file_lists){
            $where['file_lists'] = $file_lists;
        }
        $start_time = Input::get_post('start_time','','trim');
        $end_time = Input::get_post('end_time','','trim');

        if(!empty($start_time)){
            if(!Validate::required('start_time')){
                throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['addtime > '] =strtotime($start_time);
        }
        if(!empty($end_time)){
            if(!Validate::required('end_time')){
                throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['addtime < '] = strtotime($end_time);
        }

        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $form['id'] = Input::get_post('folder_id',0,'intval');

        $form = $this->doc_folder->info(['id'=>$form['id']]);
        $folders = $this->doc_folder->find_all(['status'=>0],0,1000);
        $where = $this->get_search_where();
        $page = Input::get_post('page', 1, 'intval');
        $per_page = Input::get_post('per_page', 2, 'intval');
        list($res, $total) = $this->doc_file->get_list_info($where, $page, $per_page, '*');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] = $page;
        $data['per_page'] = $per_page;
        $data['total_page'] = intval(ceil($data['total']/$data['per_page']));
        if(!isset($form['folder_id']) &&empty( $form['id'] )){
            $form['id'] = 0;
            $form['name'] = '';
        }
        $this->view->assign('folders',$folders);
        $this->view->assign('form',$form);
        $this->view->assign('data',$data);
        $this->view->display('doc/web/index/index');
    }

    public function upload(){
        $this->view->display('doc/web/index/upload');
    }

    public function file()
    {
        $form['url'] = Input::get_post('url');
        $form['file'] = Input::get_post('file');


        if(strpos($form['url'],'.doc')!==false ||strpos($form['url'],'.xls')!==false ||strpos($form['url'],'.ppt')!==false){
            $this->view->assign('form',$form);
            if(strpos($form['file'],'.docx')!=false){
                exec("cd /www/fish/web/tool/python && sudo python3 doc.py docx {$form['file']}",$output,$return);
                $form['real_file'] = str_replace('.docx','.docx.html',$form['file']);
                $form['html'] = file_get_contents($form['real_file']);
            }elseif(strpos($form['file'],'.xls')!=false){
                exec("cd /www/fish/web/tool/python && sudo python3 doc.py xlsx {$form['file']}",$output,$return);
               // echo "cd /www/fish/web/tool/python && sudo python3 doc.py xlsx {$form['file']}";
                $form['real_file'] = str_replace('.xlsx','.xlsx.html',$form['file']);
                $form['html'] = file_get_contents($form['real_file']);
            }else{
                exec("cd /www/fish/web/tool/python && sudo python3 doc.py ppt {$form['file']}",$output,$return);
              //  echo "cd /www/fish/web/tool/python && sudo python3 doc.py xlsx {$form['file']}";
                $form['real_file'] = str_replace('.ppt','.ppt.html',$form['file']);
                $form['html'] = file_get_contents($form['real_file']);
            }
            $this->view->assign('form',$form);
            $this->view->display('doc/web/index/doc');
        }elseif(strpos($form['url'],'.mp3')!==false){
            $this->view->assign('form',$form);
            $this->view->display('doc/web/index/mp3');
        }elseif(strpos($form['url'],'.mp4')!==false){
            $this->view->assign('form',$form);
            $this->view->display('doc/web/index/mp4');
        }else{
            $this->view->assign('form',$form);
            $this->view->display('doc/web/index/file');
        }

    }
}
